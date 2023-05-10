<?php

namespace App\Http\Controllers\Webpoint;

use App\Http\Controllers\Controller;
use App\Repositories\ContractRepository\ContractRepositoryInterface;
use App\Helpers\WebpointHelpers\WebpointHelpers;
use App\Http\Requests\AddContractRequest;
use App\Http\Requests\ContractDeleteRequest;
use App\Http\Requests\ContractEditRequest;
use Illuminate\Http\Request;

class ContactController extends Controller
{

    private ContractRepositoryInterface $ContractRepository;

    public function __construct(ContractRepositoryInterface $ContractRepository)
    {
        $this->ContractRepository = $ContractRepository;
    }


    public function addContact(AddContractRequest $request){
        $dataSaving = $this->ContractRepository->addContract($request->validated());
        if($dataSaving){
            return WebpointHelpers::successResponse(200 , $dataSaving , 'Contract has been added.');
        }
        return WebpointHelpers::errorResponse(422  , 'Contract has been failed to add.');
    }

    public function getContactList(Request $request){
        $searchQuery = $request->get('search');
        $dataFetching = $this->ContractRepository->getContract($searchQuery);
        if($dataFetching){
            return WebpointHelpers::successResponse(200 , $dataFetching , 'Contract has been fetched.');
        }
        return WebpointHelpers::errorResponse(422  , 'Some issue occured while getting Contract list.');
    }

    public function editContact(ContractEditRequest $request){
        $dataEditing = $this->ContractRepository->editContract($request->validated());
        if($dataEditing){
            return WebpointHelpers::successResponse(200 , $request->validated() , 'Contract has been edited.');
        }
        return WebpointHelpers::errorResponse(422  , 'Some issue occured while editing Contract list.');
    }

    public function deleteContact(ContractDeleteRequest $request){
        $dataEditing = $this->ContractRepository->deleteContract($request->validated());
        if($dataEditing){
            return WebpointHelpers::successResponse(200 , $request->validated() , 'Contract has been deleted.');
        }
        return WebpointHelpers::errorResponse(422  , 'Some issue occured while deleting Contract list.');
    }

    public function getRandomQuotes(){
        $quoteCOllection = WebpointHelpers::getQuote();
        if(count($quoteCOllection)){
            return WebpointHelpers::successResponse(200 , $quoteCOllection , 'Quote has been fetched successfully');
        }
        return WebpointHelpers::errorResponse(204  , '');
    }
    
}
