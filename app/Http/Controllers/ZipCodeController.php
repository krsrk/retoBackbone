<?php

namespace App\Http\Controllers;

use App\Http\Requests\ZipCodeRequest;
use App\Http\Resources\ZipCodeResource;
use App\Repositories\ZipCodeRepository;
use Illuminate\Http\Response;

class ZipCodeController extends Controller
{
    public function __construct(protected ZipCodeRepository $repository){}

    public function index(ZipCodeRequest $request, Response $response, string $zip_code)
    {
        $zipCodes = $this->repository->findBy('zip_code', $zip_code);

        if (is_null($zipCodes)) {
            abort(404);
        }

        return response()->json(new ZipCodeResource($zipCodes));
    }
}
