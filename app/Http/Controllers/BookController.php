<?php

namespace App\Http\Controllers;

use App\Book;
use App\Author;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class BookController extends Controller
{
    public $successStatus = 200;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id = null)
    {
        //
        $service_url = 'https://www.anapioficeandfire.com/api/books/'.$id;
        $client = new Client();
        $response = $client->request('GET',$service_url);
        $statusCode = $response->getStatusCode();
        if ($response->getStatusCode() != 200){
            return response()->json(['status_code'=>200,'status'=>'success','data'=>[]]);
        }
        $body = json_decode($response->getBody()->getContents(),true);
        $result = ['status_code'=>$statusCode,'status'=>'sucess','data'=>["name"=>$body['name'],"isbn"=>$body['isbn'],"authors"=>$body['authors'],"number_of_pages"=>$body['numberOfPages'],"publisher"=>$body['publisher'],"country"=>$body['country'],"release_date"=>$body['released']]];

        return $result;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $book = new Book;
        $book->name = $request->name;
        $book->isbn = $request->isbn;
        $book->number_of_pages = $request->number_of_pages;
        $book->publisher = $request->publisher;
        $book->country = $request->country;
        $book->release_date = $request->release_date;
        if ($book->save()){
            $author = new Author;
            $author->name = $request->authors;
            $author->book_id = $book->id;
            $author->save();
            return response()->json(['data'=>[$book,$book->authors]]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $book = Book::find($id);

        if ($book==null){
            return response()->json(['status_code'=>200,'status'=>'success','data'=>[]]);
        }
        $author = $book->author()->name;
        return response()->json(['status_code'=>200,'status'=>'success','data'=>Book::find($id),'author'=>$author]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        //
        $book = Book::all();
        if ($book==null){
            return response()->json(['status_code'=>200,'status'=>'success','data'=>[]]);
        }

//        foreach ($book as $item=>$value){
//            $list = [$item,$item->author()-name];
//        }
        return response()->json(['status_code'=>200,'status'=>'success','data'=>$book]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $book = Book::find($id);
        if ($book==null){
            return response()->json(['status_code'=>200,'status'=>'success','data'=>[]]);
        }
        $author = Author::find($book->id);
        $book->update($request->all());
        $author->name = $request->authors;
        $author->save();
        return response()->json(['status_code'=>200,'status'=>'success','message'=>'The book My First Book was updated successfully','data'=>$book,'authors'=>$request->authors]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $book = Book::find($id);
        if ($book==null){
            return response()->json(['status_code'=>200,'status'=>'success','message'=>'No such record']);
        }
        $book->delete();
        $book->author()->delete();
        return response()->json(['status_code'=>204,'status'=>'success','message'=>'The book My First Book was deleted successfully','data'=>[]]);

    }
}
