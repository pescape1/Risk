<?php

namespace App\Http\Controllers;

use App\Http\Requests\OperationRequest;
use App\Repositories\OperationRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\Operation;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Support\Facades\Input;
use DB;
use Response;

class OperationController extends AppBaseController
{
    /** @var  OperationRepository */
    private $operationRepository;

    public function __construct(OperationRepository $operationRepo)
    {
        $this->operationRepository = $operationRepo;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the Operation.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->operationRepository->pushCriteria(new RequestCriteria($request));
        $operations = $this->operationRepository->all();

        return view('operations.index')
            ->with('operations', $operations);
    }

    /**
     * Show the form for creating a new Operation.
     *
     * @return Response
     */
    public function create()
    {
        return view('operations.create');
    }

    /**
     * Store a newly created Operation in storage.
     *
     * @param CreateOperationRequest $request
     *
     * @return Response
     */
    public function store(OperationRequest $request)
    {
        $input = $request->all();
        $risks=$request->get('risk');
        $details=$request->get('detail');
        $operation = $this->operationRepository->create($input);
        $i=0;
        foreach ($risks as $risk) {
            $riesgos[]=new \App\Models\Risk([
                'operation_id'=>$operation->id,
                'risk'=>$risk,
                'detail'=>$details[$i],
            ]);
            $i++;
        }
        $operation->risks()->saveMany($riesgos);
        Flash::success('Operation saved successfully.');
        return redirect(route('operations.index'));
    }

    /**
     * Display the specified Operation.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $operation = $this->operationRepository->findWithoutFail($id);

        if (empty($operation)) {
            Flash::error('Operation not found');

            return redirect(route('operations.index'));
        }

        return view('operations.show')->with('operation', $operation);
    }

    /**
     * Show the form for editing the specified Operation.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $operation = $this->operationRepository->findWithoutFail($id);
        Input::flash();
        if (empty($operation)) {
            Flash::error('Operation not found');
            return redirect(route('operations.index'));
        }
        return view('operations.edit',compact('operation'));
    }

    /**
     * Update the specified Operation in storage.
     *
     * @param  int              $id
     * @param UpdateOperationRequest $request
     *
     * @return Response
     */
    public function update($id, OperationRequest $request)
    {
        $operation = $this->operationRepository->findWithoutFail($id);
        if (empty($operation)) {
            Flash::error('Operation not found');
            return redirect(route('operations.index'));
        }
        try {
            DB::beginTransaction();
            $operation = $this->operationRepository->update($request->all(), $id);
            $risks=$request->get('risk');
            $details=$request->get('detail');
            $i=0;
            foreach ($risks as $risk) {
                $riesgos[]=new \App\Models\Risk([
                    'operation_id'=>$operation->id,
                    'risk'=>$risk,
                    'detail'=>$details[$i],
                ]);
                $i++;
            }
            $operation->risks()->delete();
            $operation->risks()->saveMany($riesgos);
            DB::commit();
            Flash::success('Operación fue actualizada correctamente.');
        } catch(\Exception $e) {
            DB::rollback();
            Flash::error('Se produjo un error al intentar actualizar la operación. Código: '.$e->getCode());
        }
        return redirect(route('operations.index'));
    }

    /**
     * Remove the specified Operation from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $operation = $this->operationRepository->findWithoutFail($id);

        if (empty($operation)) {
            Flash::error('Operation not found');

            return redirect(route('operations.index'));
        }

        $this->operationRepository->delete($id);

        Flash::success('Operation deleted successfully.');

        return redirect(route('operations.index'));
    }
}
