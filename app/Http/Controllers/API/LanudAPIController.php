<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateLanudAPIRequest;
use App\Http\Requests\API\UpdateLanudAPIRequest;
use App\Models\Lanud;
use App\Repositories\LanudRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class LanudController
 * @package App\Http\Controllers\API
 */

class LanudAPIController extends AppBaseController
{
    /** @var  LanudRepository */
    private $lanudRepository;

    public function __construct(LanudRepository $lanudRepo)
    {
        $this->lanudRepository = $lanudRepo;
    }

    /**
     * Display a listing of the Lanud.
     * GET|HEAD /lanuds
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $lanuds = $this->lanudRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($lanuds->toArray(), 'Lanuds retrieved successfully');
    }

    /**
     * Store a newly created Lanud in storage.
     * POST /lanuds
     *
     * @param CreateLanudAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateLanudAPIRequest $request)
    {
        $input = $request->all();

        $lanud = $this->lanudRepository->create($input);

        return $this->sendResponse($lanud->toArray(), 'Lanud saved successfully');
    }

    /**
     * Display the specified Lanud.
     * GET|HEAD /lanuds/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Lanud $lanud */
        $lanud = $this->lanudRepository->find($id);

        if (empty($lanud)) {
            return $this->sendError('Lanud not found');
        }

        return $this->sendResponse($lanud->toArray(), 'Lanud retrieved successfully');
    }

    /**
     * Update the specified Lanud in storage.
     * PUT/PATCH /lanuds/{id}
     *
     * @param int $id
     * @param UpdateLanudAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateLanudAPIRequest $request)
    {
        $input = $request->all();

        /** @var Lanud $lanud */
        $lanud = $this->lanudRepository->find($id);

        if (empty($lanud)) {
            return $this->sendError('Lanud not found');
        }

        $lanud = $this->lanudRepository->update($input, $id);

        return $this->sendResponse($lanud->toArray(), 'Lanud updated successfully');
    }

    /**
     * Remove the specified Lanud from storage.
     * DELETE /lanuds/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Lanud $lanud */
        $lanud = $this->lanudRepository->find($id);

        if (empty($lanud)) {
            return $this->sendError('Lanud not found');
        }

        $lanud->delete();

        return $this->sendSuccess('Lanud deleted successfully');
    }
}
