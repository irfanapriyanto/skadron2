<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateLanudRequest;
use App\Http\Requests\UpdateLanudRequest;
use App\Repositories\LanudRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class LanudController extends AppBaseController
{
    /** @var  LanudRepository */
    private $lanudRepository;

    public function __construct(LanudRepository $lanudRepo)
    {
        $this->lanudRepository = $lanudRepo;
    }

    /**
     * Display a listing of the Lanud.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $lanuds = $this->lanudRepository->all();

        return view('lanuds.index')
            ->with('lanuds', $lanuds);
    }

    /**
     * Show the form for creating a new Lanud.
     *
     * @return Response
     */
    public function create()
    {
        return view('lanuds.create');
    }

    /**
     * Store a newly created Lanud in storage.
     *
     * @param CreateLanudRequest $request
     *
     * @return Response
     */
    public function store(CreateLanudRequest $request)
    {
        $input = $request->all();

        $lanud = $this->lanudRepository->create($input);

        Flash::success('Lanud saved successfully.');

        return redirect(route('lanuds.index'));
    }

    /**
     * Display the specified Lanud.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $lanud = $this->lanudRepository->find($id);

        if (empty($lanud)) {
            Flash::error('Lanud not found');

            return redirect(route('lanuds.index'));
        }

        return view('lanuds.show')->with('lanud', $lanud);
    }

    /**
     * Show the form for editing the specified Lanud.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $lanud = $this->lanudRepository->find($id);

        if (empty($lanud)) {
            Flash::error('Lanud not found');

            return redirect(route('lanuds.index'));
        }

        return view('lanuds.edit')->with('lanud', $lanud);
    }

    /**
     * Update the specified Lanud in storage.
     *
     * @param int $id
     * @param UpdateLanudRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateLanudRequest $request)
    {
        $lanud = $this->lanudRepository->find($id);

        if (empty($lanud)) {
            Flash::error('Lanud not found');

            return redirect(route('lanuds.index'));
        }

        $lanud = $this->lanudRepository->update($request->all(), $id);

        Flash::success('Lanud updated successfully.');

        return redirect(route('lanuds.index'));
    }

    /**
     * Remove the specified Lanud from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $lanud = $this->lanudRepository->find($id);

        if (empty($lanud)) {
            Flash::error('Lanud not found');

            return redirect(route('lanuds.index'));
        }

        $this->lanudRepository->delete($id);

        Flash::success('Lanud deleted successfully.');

        return redirect(route('lanuds.index'));
    }
}
