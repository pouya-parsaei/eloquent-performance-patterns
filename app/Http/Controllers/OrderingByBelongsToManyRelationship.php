<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Checkout;
use App\Models\User;

class OrderingByBelongsToManyRelationship extends Controller
{
    public function index()
    {
//        return Book::query()
//            ->select('books.*')
//            ->join('checkouts', 'checkouts.book_id', '=', 'books.id')
//            ->groupBy('books.id')
//            ->orderByRaw('max(checkouts.borrowed_date) desc')
//            ->withLastCheckout()
//            ->with('lastCheckout.user')
//            ->paginate();

//        return Book::query()
//            ->orderByDesc(Checkout::select('borrowed_date')
//                ->whereColumn('book_id', 'books.id')
//                ->latest('borrowed_date')
//                ->take(1)
//            )
//            ->withLastCheckout()
//            ->with('lastCheckout.user')
//            ->paginate();

        /*When pivot model does not exist*/
//        return Book::query()
//            ->orderByDesc(function($query){
//                $query->select('borrowed_date')
//                    ->from('checkouts')
//                    ->whereColumn('book_id','books.id')
//                    ->latest('borrowed_date')
//                    ->take(1);
//            })
//            ->withLastCheckout()
//            ->with('lastCheckout.user')
//            ->paginate();
        /*When pivot model does not exist*/


        return Book::query()
            ->orderBy(User::select('first_name')
                ->join('checkouts', 'checkouts.user_id', '=', 'users.id')
                ->whereColumn('checkouts.book_id', 'books.id')
                ->latest('checkouts.borrowed_date')
                ->take(1)
            )
            ->withLastCheckout()
            ->with('lastCheckout.user')
            ->paginate();
    }
}
