<?php

use League\Fractal\Manager;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

class GroupsController extends AppController
{

    protected $groupTransformer;

    /**
     * @param GroupTransformer $groupTransformer
     */
    function __construct(GroupTransformer $groupTransformer)
    {
        $this->groupTransformer = $groupTransformer;
    }

    /**
     * Display a listing of the resource.
     * GET /groups
     *
     * @return Response
     */
    public function index()
    {
        try {
            $limit = Input::get('limit') ?: 15;

            $groups = Group::with('owner.profile_image', 'members.profile.profile_image','group_image')->paginate($limit);

            if (!$groups) {
                return $this->responseNotFound('Groups Not Found!');
            }

            $fractal = new Manager();

            $groupsResource = new Collection($groups, new GroupTransformer());

            $groupsResource->setPaginator(new IlluminatePaginatorAdapter($groups));

            $data = $fractal->createData($groupsResource);

            return $data->toJson();
        } catch (Exception $e) {

            return $this->setStatusCode(500)->respondWithError($e);
        }
    }

    /**
     * Display a listing of the resource.
     * GET /groups
     *
     * @return Response
     */
    public function getMyGroups($id)
    {
        try {
            $limit = Input::get('limit') ?: 15;

            $groups = Group::with('owner.profile_image', 'members.profile.profile_image','group_image')->where('owner_id', $id)->paginate($limit);

            if (!$groups) {
                return $this->responseNotFound('Groups Not Found!');
            }

            $fractal = new Manager();

            $groupsResource = new Collection($groups, new GroupTransformer());

            $groupsResource->setPaginator(new IlluminatePaginatorAdapter($groups));

            $data = $fractal->createData($groupsResource);

            return $data->toJson();
        } catch (Exception $e) {

            return $this->setStatusCode(500)->respondWithError($e);
        }
    }

    public function getCoverPic($groupId)
    {
        try {
            $coverImagePointer = GroupImage::where('group_id', $groupId)->first();

            if(! $coverImagePointer)
            {
                // For beta site
//                 return "2015-02-17-04:36:11-eve-avatar.png";
                // for test site.

                return "NoCoverImage";
            }
            else
            {
                if ($coverImagePointer->image_id != 0)
                {
                    $coverImage = EvezownImage::where('id', $coverImagePointer->image_id)->orderBy('created_at', 'DESC')->first();
                    return $coverImage->large_image_url;
                }
                else
                {
                    return "NoCoverImage";
                }
            }

        } catch (Exception $e) {
            return $this->setStatusCode(500)->respondWithError('Error occured!');
        }
    }

    public function updateGroupPhoto() {
        try{
            $input = Input::all();

            $input_array = $input['data'];

            $group_id = $input_array['group_id'];
            $imageName = $input_array['image_name'];

            $image = EvezownImage::create([
                    'large_image_url' => $imageName
                ]
            );


            $groupImage = GroupImage::firstOrCreate(array('group_id' => $group_id));

            $groupImage->image_id = $image['id'];

            $groupImage->save();




            $successResponse = [
                'status' => true,
                'message' => 'Images updated for group successfully!'
            ];

            return $this->setStatusCode(200)->respond($successResponse);

        } catch (Exception $e) {

            return $this->setStatusCode(500)->respondWithError($e);
        }
    }

    /**
     * Display a listing of the resource.
     * GET /circles
     *
     * @return Response
     */
    public function showGroup($group_id)
    {
        try {
            $group = Group::with('owner.profile_image', 'members.profile.profile_image')->find($group_id);

            if (!$group) {
                return $this->responseNotFound('Group Not Found!');
            }

            $fractal = new Manager();

            $groupsResource = new Item($group, new GroupTransformer());

            $data = $fractal->createData($groupsResource);

            return $data->toJson();
        } catch (Exception $e) {

            return $this->setStatusCode(500)->respondWithError($e);
        }
    }

    /**
     * Store a newly created resource in storage.
     * POST /groups
     *
     * @return Response
     */
    public function store()
    {
        try {
            $input = Input::all();

            $input_array = $input['data'];

            $ownerId = $input_array['user_id'];
            $title = $input_array['title'];
            $description = $input_array['description'];
            $visibility_id = $input_array['visibility_id'];

            $group = Group::create([
                'owner_id' => $ownerId,
                'title' => $title,
                'description' => $description,
                'visibility_id' => $visibility_id
            ]);

            //$group->owner_id = $ownerId;

            //$group->save();

            $successResponse = [
                'status' => true,
                'id' => $group->id,
                'message' => 'Group created successfully!'
            ];

            return $this->setStatusCode(200)->respond($successResponse);

        } catch (Exception $e) {

            return $this->setStatusCode(500)->respondWithError($e);
        }
    }

    /**
     * Add a friend to circle
     * POST /circles
     *
     * @return Response
     */
    public function addToGroup()
    {
        try {
            $input = Input::all();

            $input_array = $input['data'];

            $memberId = $input_array['user_id'];
            $groupId = $input_array['group_id'];

            $groupMember = GroupUser::where('group_id', $groupId)
                ->where('user_id', $memberId)
                ->first();
            if($groupMember != null){
                if($groupMember->status == "added"){
                        return $this->responseNotFound('Already sent a request to this user');
                }else{
                    $groupMember->status ="added";
                    $groupMember->save();    
                }
            }else{
                   $groupMember = GroupUser::create([
                        'group_id' => $groupId,
                        'user_id' => $memberId,
                        'status' => 'added'
                    ]); 
            }

            $successResponse = [
                'status' => true,
                'id' => $groupMember->id,
                'message' => 'Add requested sent to user successfully!'
            ];

            return $this->setStatusCode(200)->respond($successResponse);

        } catch (Exception $e) {

            return $this->setStatusCode(500)->respondWithError($e);
        }
    }

    /**
     * Remove a friend from circle
     * @return mixed
     */
    public function removeFromGroup()
    {
        try {
            $input = Input::all();

            $input_array = $input['data'];

            $userId = $input_array['user_id'];
            $groupId = $input_array['group_id'];

            $groupUser = GroupUser::where('group_id', $groupId)
                ->where('user_id', $userId)
                ->where('status', 'approved')
                ->first();

            if (!$groupUser) {
                return $this->responseNotFound('Member not found in group!');
            }

            $groupUser->delete();

            $successResponse = [
                'status' => true,
                'message' => 'Member removed from group successfully!'
            ];

            return $this->setStatusCode(200)->respond($successResponse);

        } catch (Exception $e) {

            return $this->setStatusCode(500)->respondWithError($e);
        }
    }

    /**
     * @return mixed
     */
    public function requestAddToGroup()
    {
        try {
            $input = Input::all();

            $input_array = $input['data'];

            $memberId = $input_array['user_id'];
            $groupId = $input_array['group_id'];

            $group = Group::find($groupId);

            if (!$group) {
                return $this->responseNotFound('Group Not Found!');
            }
            $groupUser = GroupUser::where('group_id', $groupId)
                ->where('user_id', $memberId)
                ->where('status', 'requested')
                ->orWhere('status', 'added')
                ->first();

            $approvedGroupUser = GroupUser::where('group_id', $groupId)
                ->where('user_id', $memberId)
                ->where('status', 'approved')
                ->first();
            if($groupUser)
            {
                return $this->responseNotFound('Request already exist');
            }
            else if($approvedGroupUser)
            {
                return $this->responseNotFound('Already a member');
            }
            else
            {
                $groupMember = GroupUser::create([
                    'group_id' => $groupId,
                    'user_id' => $memberId,
                    'status' => 'requested'
                ]);
            }


            $successResponse = [
                'status' => true,
                'id' => $groupMember->id,
                'message' => 'Request sent to group owner successfully'
            ];

            return $this->setStatusCode(200)->respond($successResponse);

        } catch (Exception $e) {

            return $this->setStatusCode(500)->respondWithError($e);
        }
    }


    /**
     * Approve the group member request. Group owner needs to approve the member.
     * @return mixed
     */
    public function approveMember () {
        try {
            $input = Input::all();

            $input_array = $input['data'];

            $memberId = $input_array['user_id'];
            $groupId = $input_array['group_id'];

            $group = Group::find($groupId);

            if (!$group) {
                return $this->responseNotFound('Group Not Found!');
            }

            $groupMember = GroupUser::where('group_id', $groupId)
                                      ->where('user_id', $memberId)->first();

            if(!$groupMember) {
                return $this->responseNotFound('Group request does not exist!');
            }

            $groupMember->status = 'approved';
            $groupMember->save();

            $successResponse = [
                'status' => true,
                'message' => 'Group request approved successfully!'
            ];

            return $this->setStatusCode(200)->respond($successResponse);

        } catch (Exception $e) {

            return $this->setStatusCode(500)->respondWithError($e);
        }
    }

    /**
     * Reject the group request. Group owner needs to do it.
     * @return mixed
     */
    public function rejectMember() {
        try {
            $input = Input::all();

            $input_array = $input['data'];

            $memberId = $input_array['user_id'];
            $groupId = $input_array['group_id'];

            $group = Group::find($groupId);

            if (!$group) {
                return $this->responseNotFound('Group Not Found!');
            }

            $groupMember = GroupUser::where('group_id', $groupId)
                ->where('user_id', $memberId)->first();

            if(!$groupMember) {
                return $this->responseNotFound('Group request does not exist!');
            }

            $groupMember->status = 'rejected';
            $groupMember->save();

            $successResponse = [
                'status' => true,
                'message' => 'Group request rejected successfully!'
            ];

            return $this->setStatusCode(200)->respond($successResponse);

        } catch (Exception $e) {

            return $this->setStatusCode(500)->respondWithError($e);
        }
    }

    /**
     * Member approves the add to group request.
     * @return mixed
     */
    public function approveAddMember() {
        try {
            $input = Input::all();

            $input_array = $input['data'];

            $memberId = $input_array['user_id'];
            $groupId = $input_array['group_id'];

            $group = Group::find($groupId);

            if (!$group) {
                return $this->responseNotFound('Group Not Found!');
            }

            $groupMember = GroupUser::where('group_id', $groupId)
                            ->where('user_id', $memberId)->first();

            if(!$groupMember) {
                return $this->responseNotFound('Group request does not exist!');
            }

            $groupMember->status = 'approved';
            $groupMember->save();

            $successResponse = [
                'status' => true,
                'message' => 'Group request approved successfully!'
            ];

            return $this->setStatusCode(200)->respond($successResponse);

        } catch (Exception $e) {

            return $this->setStatusCode(500)->respondWithError($e);
        }
    }

    /**
     * @param $ownerId
     * @return mixed|string
     */
    public function getAllAddRequests($userId)
    {
        try {
            $limit = Input::get('limit') ?: 15;

            $groupRequests = GroupUser::with('group.owner.profile_image','profile.profile_image')
                                        ->where('status', 'added')
                                        ->where('user_id', $userId)->paginate($limit);

            if (!$groupRequests) {
                return $this->responseNotFound('No Group requests found!');
            }

            return $groupRequests;
        } catch (Exception $e) {

            return $this->setStatusCode(500)->respondWithError($e);
        }
    }

    /**
     * @param $ownerId
     * @return mixed|string
     */
    public function getAllGroupRequests($ownerId)
    {
        try {

            $limit = Input::get('limit') ?: 15;
            $groupRequests = GroupUser::with('group.owner' ,'profile.profile_image')
                                        ->where('status', 'requested')
                                        ->whereExists(function ($query) use ($ownerId) {
                                        $query->select(DB::raw(1))
                                            ->from('groups')
                                            ->whereRaw('groups.id = group_user_profile.group_id')
                                            ->whereRaw('groups.owner_id = ' . $ownerId);
                                        })
                                        ->paginate($limit);

            if (!$groupRequests) {
                return $this->responseNotFound('No Group requests found!');
            }

            return $groupRequests;
        } catch (Exception $e) {

            return $this->setStatusCode(500)->respondWithError($e);
        }
    }

    /**
     * Check whether the user belongs to group
     * @param $groupId
     * @param $userId
     * @return mixed
     */
    public function isValidGroupMember($groupId, $userId) {
        try {
            $groupMember = GroupUser::where('group_id', $groupId)
                                        ->where('user_id', $userId)
                                        ->first();

            if (!$groupMember) {
                return $this->setStatusCode(403)->respondWithError('User is not a group member');
            }

            $successResponse = [
                'status' => true,
                'message' => 'User belongs to group!'
            ];

            return $this->setStatusCode(200)->respond($successResponse);
        } catch (Exception $e) {

            return $this->setStatusCode(500)->respondWithError($e);
        }
    }

    /**
     * Update the specified resource in storage.
     * PUT /groups/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function update()
    {
        try {
            $input = Input::all();

            $input_array = $input['data'];

            $groupId = $input_array['group_id'];

            $group = Group::find($groupId);

            if (!$group) {
                return $this->responseNotFound('Group does not exist!');
            }

            if (isset($input_array['title'])) {
                $title = $input_array['title'];

                $group->title = $title;
            }

            //$visibility_id

            if (isset($input_array['visibility_id'])) {
                $visibility_id = $input_array['visibility_id'];

                $group->visibility_id = $visibility_id;
            }

            if (isset($input_array['description'])) {
                $description = $input_array['description'];

                $group->description = $description;
            }

            // Update circle.
            $group->save();

            $successResponse = [
                'status' => true,
                'message' => 'Group updated successfully!'
            ];

            return $this->setStatusCode(200)->respond($successResponse);

        } catch (Exception $e) {

            return $this->setStatusCode(500)->respondWithError($e);
        }
    }


    public function storeGroupGrade()
    {
        try {
            $input = Input::all();

            $inputs_array = $input['data'];

            $ownerId = $inputs_array['owner_id'];
            $group_id = $inputs_array['group_id'];
            $scale = $inputs_array['scale'];


            $groupGrade = GroupGrade::where('grader_id', $ownerId)
                ->where('group_id', $group_id)
                ->first();

            $grade = null;

            if(! $groupGrade)
            {
                $grade = Grade::Create([
                    'scale' => $scale,
                ]);

                GroupGrade::Create([
                    'grader_id' => $ownerId,
                    'group_id' => $group_id,
                    'grade_id' => $grade->id,
                ]);
            }
            else
            {
                $grade = Grade::find($groupGrade->grade_id);

                $grade->scale = $scale;

                $grade->save();
            }

            $avgGrade = EventGrade::join('grades', 'group_grades.grade_id', '=', 'grades.id')
                ->where('group_grades.group_id', $group_id)
                ->avg('scale');

            $successResponse = [
                'status' => true,
                'message' => 'Graded successfully!',
                'avgGrade' => round($avgGrade,1)
            ];

            return $this->setStatusCode(200)->respond($successResponse);
        } catch (Exception $e) {
            $errorMessage = [
                'status' => false,
                'message' => "Something went wrong. Please try again later!"
            ];

            return $this->setStatusCode(500)->respondWithError($errorMessage);
        }
    }

    /**
     * Display the specified resource.
     * GET /album_image_grades/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function showGrade($group_id)
    {
        $avgGrade = GroupGrade::join('grades', 'group_grades.grade_id', '=', 'grades.id')
            ->where('group_grades.group_id', $group_id)
            ->avg('scale');

        return number_format($avgGrade,1);
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /groups/{id}
     *
     * @param $groupId
     * @return Response
     * @internal param int $id
     */
    public function destroy($groupId)
    {
        try {
            $group = Group::find($groupId);

            if (!$group) {
                return $this->responseNotFound('Group does not exist!');
            }

            $groupFriends = GroupUser::where('group_id', $groupId)->get();

            foreach ($groupFriends as $groupMember) {
                $groupMember->delete();
            }

            // Remove the entry from circle table.
            $group->delete();

            $successResponse = [
                'status' => true,
                'message' => 'Group deleted successfully!'
            ];

            return $this->setStatusCode(200)->respond($successResponse);

        } catch (Exception $e) {

            return $this->setStatusCode(500)->respondWithError($e);
        }
    }

}