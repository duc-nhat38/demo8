<?php

namespace App\Http\Controllers;

use App\Models\BusinessType;
use App\Repositories\BusinessRepositoryInterface;
use Illuminate\Http\Request;

class BusinessTypeController extends Controller
{
    protected $businessRepository;

    public function __construct(BusinessRepositoryInterface $businessRepositoryInterface)
    {
        $this->businessRepository = $businessRepositoryInterface;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $business = $this->businessRepository->all();

        return response()->json($business, 200);
    }
    
}
