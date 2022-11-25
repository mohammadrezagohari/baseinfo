<?php

namespace App\Http\Controllers;

use App\Enums\DataTypeEnum;
use App\Http\Requests\BaseInfoStoreRequest;
use App\Http\Requests\BaseInfoUpdateRequest;
use App\Http\Resources\BaseInfoCollection;
use App\Repositories\MongoDB\BaseInfoRepository\BaseInfoRepository;

use App\Repositories\MongoDB\BaseInfoRepository\IBaseInfoRepository;
use Symfony\Component\HttpFoundation\Response as HTTPResponse;

class BaseInfoController extends Controller
{
    /****************************************************
     * @var IBaseInfoRepository $baseInfoRepositoryInterface
     ****************************************************/
    private IBaseInfoRepository $baseInfoRepositoryInterface;

    public function __construct(IBaseInfoRepository $IBaseInfoRepository)
    {
        $this->baseInfoRepositoryInterface = $IBaseInfoRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($page = null, $per_page = 2)
    {
        return new BaseInfoCollection($this->baseInfoRepositoryInterface->getAllWithPaginate($per_page, $page));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(BaseInfoStoreRequest $request)
    {
        return $this->baseInfoRepositoryInterface->insertData($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->baseInfoRepositoryInterface->findById($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, BaseInfoUpdateRequest $request)
    {
        if ($this->baseInfoRepositoryInterface->updateData($id, $request))
            return response()->json(['message' => 'successfully your transaction!'], HTTPResponse::HTTP_OK);
        return response()->json(['message' => 'sorry, your transaction fails!'], HTTPResponse::HTTP_BAD_REQUEST);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($this->baseInfoRepositoryInterface->deleteData($id))
            return response()->json(['message' => 'successfully your transaction!'], HTTPResponse::HTTP_OK);
        return response()->json(['message' => 'sorry, your transaction fails!'], HTTPResponse::HTTP_BAD_REQUEST);
    }
}
