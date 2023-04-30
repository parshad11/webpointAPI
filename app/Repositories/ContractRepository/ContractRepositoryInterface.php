<?php
namespace App\Repositories\ContractRepository;

interface ContractRepositoryInterface{

    public function addContract($request);
    public function getContract($searchQuery);
    public function editContract($request);
    public function deleteContract($request);
    
}