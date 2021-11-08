<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateEstimateAPIRequest;
use App\Http\Requests\API\UpdateEstimateAPIRequest;
use App\Models\Estimate;
use App\Repositories\EstimateRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class EstimateController
 * @package App\Http\Controllers\API
 */

class EstimateAPIController extends AppBaseController
{
    /** @var  EstimateRepository */
    private $estimateRepository;

    public function __construct(EstimateRepository $estimateRepo)
    {
        $this->estimateRepository = $estimateRepo;
    }

    /**
     * Display a listing of the Estimate.
     * GET|HEAD /estimates
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $estimates = $this->estimateRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($estimates->toArray(), 'Estimates retrieved successfully');
    }

    /**
     * Store a newly created Estimate in storage.
     * POST /estimates
     *
     * @param CreateEstimateAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateEstimateAPIRequest $request)
    {
        $input = $request->all();

        $estimate = $this->estimateRepository->create($input);

        return $this->sendResponse($estimate->toArray(), 'Estimate saved successfully');
    }

    /**
     * Display the specified Estimate.
     * GET|HEAD /estimates/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Estimate $estimate */
        $estimate = $this->estimateRepository->find($id);

        if (empty($estimate)) {
            return $this->sendError('Estimate not found');
        }

        return $this->sendResponse($estimate->toArray(), 'Estimate retrieved successfully');
    }

    // Search estimate
    public function search(Request $request)
    {

        $from = $request->get('from');
        $to = $request->get('to');
        $estimate = estimate::where('lanud_from',$from)
                                ->where('lanud_to',$to)
                                ->first();


        if (empty($estimate)) {
            return $this->sendError('Estimate not found');
        }

        return $this->sendResponse($estimate->toArray(),'Estimates successfully');
    }

    /**
     * Update the specified Estimate in storage.
     * PUT/PATCH /estimates/{id}
     *
     * @param int $id
     * @param UpdateEstimateAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEstimateAPIRequest $request)
    {
        $input = $request->all();

        /** @var Estimate $estimate */
        $estimate = $this->estimateRepository->find($id);

        if (empty($estimate)) {
            return $this->sendError('Estimate not found');
        }

        $estimate = $this->estimateRepository->update($input, $id);

        return $this->sendResponse($estimate->toArray(), 'Estimate updated successfully');
    }

    /**
     * Remove the specified Estimate from storage.
     * DELETE /estimates/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Estimate $estimate */
        $estimate = $this->estimateRepository->find($id);

        if (empty($estimate)) {
            return $this->sendError('Estimate not found');
        }

        $estimate->delete();

        return $this->sendSuccess('Estimate deleted successfully');
    }
}
