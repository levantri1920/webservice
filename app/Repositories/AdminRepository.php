<?php

namespace App\Repositories;

use App\Models\ServiceBill;
use App\Models\UserTransaction;

class AdminRepository
{
    /**
     * Get member collection paginate.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */

    public function getRechargeHistory()
    {
        return UserTransaction::join('users as u', 'user_transactions.user_id', '=', 'u.id')
                        ->select([
                            'user_transactions.*',
                            'u.name as user_name',
                            'u.avatar as avatar',
                            'u.email'
                        ])
                        ->orderBy('id', 'desc');
    }

    public function serviceBills()
    {
        return ServiceBill::join('users', 'service_bills.user_id', '=', 'users.id')
                                ->join('services as sv', 'service_bills.service_id', '=', 'sv.id')
                                ->join('categories as cate', 'cate.id', '=', 'sv.category_id')
                                ->join('service_packs as svp', 'svp.id', '=', 'sv.service_pack_id')
                                ->select([
                                    'service_bills.*',
                                    'sv.name as service_name',
                                    'sv.image as service_image',
                                    'svp.name as svp_name',
                                    'svp.price as price',
                                    'cate.image as cate_image',
                                    'cate.name as cate_name',
                                    'users.email as email',
                                    'users.name as user_name',
                                    'users.avatar as avatar'
                                ])
                                ->orderBy('id', 'desc');
    }
}
