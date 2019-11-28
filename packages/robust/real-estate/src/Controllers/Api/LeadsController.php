<?php

namespace Robust\RealEstate\Controllers\Api;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Robust\Core\Controllers\Admin\Traits\ApiTrait;
use Robust\RealEstate\Models\Lead;
use Robust\RealEstate\Models\LeadCategory;
use Robust\RealEstate\Models\LeadMetadata;
use Robust\RealEstate\Models\Note;
use Robust\RealEstate\Models\Status;
use Robust\RealEstate\Models\UserSearch;
use Robust\RealEstate\Repositories\Api\LeadRepositories;
use Robust\RealEstate\Resources\Lead as LeadResource;
use Robust\RealEstate\Resources\LeadMetadata as LeadMetadataResource;
use Robust\RealEstate\Resources\Status as LeadStatusResource;


/**
 * Class LeadsController
 * @package Robust\RealEstate\Controllers\Api
 */
class LeadsController extends Controller
{
    use ApiTrait;

    /**
     * @var LeadRepositories
     */
    /**
     * @var LeadRepositories|string
     */
    protected $model,$resource;
    protected $storeRequest,$updateRequest;
    /**
     * LeadsController constructor.
     * @param LeadRepositories $model
     */
    public function __construct(LeadRepositories $model)
    {
        $this->model = $model;
        $this->resource = 'Robust\RealEstate\Resources\Lead';
        $this->storeRequest = [
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'email' => 'required|max:255|unique:leads',
            'deal_type' => 'required|unique:leads',
            'username' => 'required',
            'password' => 'required',
            'activation_status' => 'required'
        ];
        $this->updateRequest = [
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'email' => 'required|max:255',
            'deal_type' => 'required',
            'username' => 'required',
            'activation_status' => 'required'
        ];
    }

    public function index()
    {
        return $this->resource::collection($this->model
            ->with('metadata')
            ->with('search')
            ->with('category')
            ->with('reports')
            ->with('email')
            ->with('activityLog')
            ->with('note')
            ->paginate(10));
    }

    public function details($id)
    {
        $model = $this->model->with('metadata')
            ->with('searches')
            ->with('categories')
            ->with('reports')
            ->with('emails')
            ->with('activityLog')
            ->with('notes');
        if($id === 'all'){
            return $this->resource::collection($model->paginate(10));
        }
        return new $this->resource($this->model->find($id));
    }
    /**
     * @param $type
     * @param \Robust\Leads\Models\Lead $lead
     * @param \Carbon\Carbon $carbon
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getLeadsByType($type)
    {
        $userArr = $this->model->byType($type);
        return LeadResource::collection($userArr);
    }

    /**
     * @param $id
     * @param \Robust\Leads\Models\Lead $lead
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getLeadsByAgent($id)
    {
        $leadArr = $this->model->byAgent($id);
        return LeadResource::collection($leadArr->paginate(10));
    }

    /**
     * @param \Robust\Leads\Models\LeadMetadata $leadMetadata
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getAllMetadata(LeadMetadata $leadMetadata)
    {
        return LeadMetadataResource::collection($leadMetadata->paginate(10));
    }

    /**
     * @param $id
     * @param \Robust\Leads\Models\Lead $lead
     * @return \Robust\Leads\Resources\Lead
     */
    public function getLead()
    {
        $lead = $this->model->getLead();
        return new LeadResource($lead);
    }

    /**
     * @param $id
     * @param \Robust\Leads\Models\LeadMetadata $leadMetadata
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getLeadMetadata($id, LeadMetadata $leadMetadata)
    {
        return LeadMetadataResource::collection($leadMetadata->where('lead_id', $id)->get());
    }

    /**
     * @param \Robust\Leads\Models\Status $status
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getAllStatus(Status $status)
    {
        return LeadStatusResource::collection($status->all());
    }

    /**
     * @param $id
     * @param \Illuminate\Http\Request $request
     * @param \Robust\Leads\Models\Lead $leadModel
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateLeadStatus($id, Request $request, Lead $leadModel)
    {
        $lead = $leadModel->find($id);
        $lead->status_id = $request->status_id;
        if ($lead->save()) {
            return response()->json(['message' => 'Successfully Updated.']);
        }
        return response()->json(['message' => 'Update Failed. Please try again later.']);
    }


    /**
     * @param \Illuminate\Http\Request $request
     * @param \Robust\Leads\Models\Note $note
     * @param \Robust\Leads\Models\LeadMetadata $leadMetadata
     * @return \Illuminate\Http\JsonResponse
     */
    public function addNote(Request $request, Note $note, LeadMetadata $leadMetadata)
    {
        $user = auth()->user();
        $data = $request->only(['lead_id', 'note_title', 'note']);
        $data['title'] = $data['note_title'];
        unset($data['note_title']);
        $data['agent_id'] = $user->id;

        $result = $note->query()->create($data);
        if ($result) {
            // Also update leads_metadata table
            $meta_data = $leadMetadata->where('lead_id', $request->lead_id)->first();
            if (!empty($meta_data)) {
                $meta_data->notes_count = $note->where('lead_id', $request->lead_id)->count();
                $meta_data->save();
            }

            return response()->json([
                'message' => 'Success'
            ]);
        }

        return response()->json([
            'message' => 'Error occurred while adding Note!'
        ]);
    }


    /**
     * @param \Illuminate\Http\Request $request
     * @param \Robust\Leads\Models\Note $note
     * @param \Robust\Leads\Models\LeadMetadata $leadMetadata
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteNote(Request $request, Note $note, LeadMetadata $leadMetadata)
    {
        $note_id = $request->note_id;
        $lead_id = $request->lead_id;

        if (!empty($note_id) && !empty($lead_id)) {
            $note->where('id', $note_id)->delete();
            // Also update leads_metadata table
            $meta_data = $leadMetadata->where('lead_id', $request->lead_id)->first();
            if (!empty($meta_data)) {
                $meta_data->notes_count = $note->where('lead_id', $request->lead_id)->count();
                $meta_data->save();
            }

            return response()->json([
                'message' => 'Successfully Deleted!'
            ]);
        }

        return response()->json([
            'message' => 'Error occurred while deleting Note!'
        ]);
    }


    /**
     * @param \Illuminate\Http\Request $request
     * @param \Robust\Leads\Models\Note $noteModel
     * @param \Robust\Leads\Models\LeadMetadata $leadMetadata
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateNote(Request $request, Note $noteModel, LeadMetadata $leadMetadata)
    {
        $noteModel->where('id', $request->note_id)->update([
            'title' => $request->note_title,
            'note' => $request->note
        ]);

        // Update lead metadata for notes
        $notesCount = $noteModel->where('lead_id', $request->lead_id)->count();
        $leadMetadata->where('id', $request->lead_id)->update([
            'notes_count' => $notesCount
        ]);

        return response()->json([
            'message' => 'Success.'
        ]);
    }


    /**
     * @param \Illuminate\Http\Request $request
     * @param \Robust\Leads\Models\UserSearch $userSearch
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteLeadSearch($id, UserSearch $userSearch)
    {
        $success = 'Failed to delete!';
        $user_search = $userSearch->find($id);
        if (isset($user_search) && !empty($user_search)) {
            if ($user_search->delete()) {
                $success = 'Success!';
            }
        }
        return response()->json(['message' => $success]);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \Robust\Leads\Models\UserSearch $userSearch
     * @return \Illuminate\Http\JsonResponse
     */
    public function addLeadSearch(Request $request, UserSearch $userSearch)
    {
        try {
            $search = new UserSearch();
            $search->user_id = $request->get('user_id');
            $search->name = $request->get('name');
            $search->frequency = $request->get('frequency');
            $search->content = json_encode($request->get('content'), true);
            $search->reference_time = now();
            $search->save();
            return response()->json(['message' => 'Success']);
        } catch (Exception $e) {
            return response()->json(['message' => 'Failed to send', 'error' => $e]);
        }
    }


    /**
     * @param \Illuminate\Http\Request $request
     * @param \Robust\Leads\Models\UserSearch $userSearch
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateLeadSearch(Request $request, UserSearch $userSearch)
    {
        try {
            $search = [
                'user_id' => $request->get('user_id'),
                'name' => $request->get('name'),
                'frequency' => $request->get('frequency'),
                'content' => json_encode($request->get('content'), true),
            ];
            $userSearch->where('id', $request->get('id'))->update($search);
            return response()->json(['message' => 'Success']);
        } catch (Exception $e) {
            return response()->json(['message' => 'Failed to send', 'error' => $e]);
        }
    }


    /**
     * @param $id
     * @param \Robust\Leads\Models\LeadCategory $leadCategory
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteLeadCategory($id, LeadCategory $leadCategory)
    {
        $success = 'Failed to delete!';
        $lead_category = $leadCategory->find($id);
        if (isset($lead_category) && !empty($lead_category)) {
            if ($lead_category->delete()) {
                $success = 'Success!';
            }
        }
        return response()->json(['message' => $success]);
    }


    /**
     * @param \Illuminate\Http\Request $request
     * @param \Robust\Leads\Models\LeadCategory $leadCategory
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeLeadCategory(Request $request, LeadCategory $leadCategory)
    {
        try {
            $updatedLeadCategory = $request->all();
            $leadCategory->create($updatedLeadCategory);
            return response()->json(['message' => 'Success']);
        } catch (Exception $e) {
            return response()->json(['message' => 'Failed to update!', 'error' => $e]);
        }
    }


}
