<?php

namespace App\Services;

use App\Http\Requests\AddressRequest;
use App\Models\Address;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;

class AddressService
{
        /**
     * Display a listing of the resource.
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function index() : JsonResponse
    {
        try {

            $addresses = Address::all();
            return response()->json($addresses);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function create() : JsonResponse
    {
        try {
            $address = new Address();
            return response()->json($address);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Illuminate\Foundation\Http\FormRequest  $request
     * @return Illuminate\Http\JsonResponse
     */
    public function store(AddressRequest $request) : JsonResponse
    {
        try {
            $address = Address::create($request->all());
            return response()->json($address);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Illuminate\Http\JsonResponse
     */
    public function show(int $id) : JsonResponse
    {
        try {
            $address = Address::find($id);
            return response()->json($address);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Illuminate\Http\JsonResponse
     */
    public function edit(int $id) : JsonResponse
    {
        try {
            $address = Address::find($id);
            return response()->json($address);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Illuminate\Foundation\Http\FormRequest  $request
     * @param  int  $id
     * @return Illuminate\Http\JsonResponse
     */
    public function update(AddressRequest $request, int $id) : JsonResponse
    {
        try {
            $address = Address::find($id);
            $address->update($request->all());
            return response()->json($address);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Illuminate\Http\JsonResponse
     */
    public function destroy( int $id) : JsonResponse
    {
        try {
            $address = Address::find($id);
            $address->delete();
            return response()->json($address);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Busca por CEP
     *
     * @param  int  $cep
     * @return \Illuminate\Http\Response
     */
    public function busca($cep)
    {
        try {
            $cep = preg_replace("/[^0-9]/", "", $cep);
            $address = Address::where('zip_code', $cep)->first();

            if (!$address) {
                //Busca externa via API
                $address = $this->buscaExterna($cep);
            }

            return response()->json($address);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Busca externa via API
     *
     * @param  int  $cep
     * @return \Illuminate\Http\Response
     */
    private function buscaExterna($cep)
    {
        $url = "https://viacep.com.br/ws/$cep/json/";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
        curl_close($ch);
        $address = json_decode($result);

        //Traduz o resultado para o inglês
        $address = $this->traduzEndereco($address);

        return $address;
    }

    /**
     * Traduz o endereço para o inglês
     *
     * @param  object  $address
     * @return array
     */
    private function traduzEndereco(object $address) : array
    {
        //Traduz campos do array
        $addressEn = [
            'street' => $address->logradouro,
            'neighborhood' => $address->bairro,
            'city' => $address->localidade,
            'state' => $address->uf
        ];

        return $addressEn;
    }

    /**
     * Busca por logradouro
     *
     * @param  string  $logradouro
     * @return \Illuminate\Http\Response

     */
    public function buscaLogradouro( string $logradouro = null) : JsonResponse
    {
        try {
            if (is_null($logradouro)) {
                $adresses = Address::all();
                return response()->json($adresses);
            }

            $address = Address::where('street', 'LIKE',  '%' . $logradouro . '%')->get();
            return response()->json($address);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
