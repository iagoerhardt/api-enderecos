<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddressRequest;
use Illuminate\Http\Request;
use App\Services\AddressService;

class AddressController extends Controller
{
    protected $service;

    public function __construct(AddressService $service)
    {
        //Separando as regras de negócio da camada de controller
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $request = $this->service->index();
        return $request;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $request = $this->service->create();
        return $request;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddressRequest $request)
    {
        $request = $this->service->store($request);
        return $request;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $request = $this->service->show($id);
        return $request;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $request = $this->service->edit($id);
        return $request;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AddressRequest $request, $id)
    {
        $request = $this->service->update($request, $id);
        return $request;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $request = $this->service->destroy($id);
        return $request;
    }

    /**
     * Busca por CEP
     *
     * @param  int  $cep
     * @return \Illuminate\Http\Response
     */
    public function busca($cep)
    {
        $request = $this->service->busca($cep);
        return $request;
    }

    /**
     * Busca por logradouro
     *
     * @param  int  $street
     * @return \Illuminate\Http\Response
     */
    public function buscaLogradouro($logradouro = null)
    {
        $request = $this->service->buscaLogradouro($logradouro);
        return $request;
    }
}
