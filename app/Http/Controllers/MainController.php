<?php
namespace App\Http\Controllers;

use App\Word;
use App\History;
use Illuminate\Http\Request;

class MainController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('main');
    }

    public function getWord()
    {
        $wordIds = ! empty(auth()->user()->words) ? explode(',', auth()->user()->words) : "";
        $generateWord = Word::with('category')
                        ->when(! empty($wordIds), function ($query) use ($wordIds){
                            return $query->whereNotIn('id', $wordIds);
                        })
                        ->when(config('database.default') == 'mysql', function ($query) {
                            return $query->orderByRaw('RAND()');
                        })
                        ->when(config('database.default') == 'sqlite', function ($query) {
                            return $query->orderByRaw('RANDOM()');
                        })
                        ->first();
    
            $response = [
                'id'       => $generateWord->id,
                'word'     => $generateWord->word_shuffled,
                'category' => $generateWord->category->category
            ];

        return response()->json($response);
    }

    public function postWord(Request $request)
    {
        $wordID = $request->word_id;
        $answer = $request->answer;

        $words = Word::find($wordID);
        $user = auth()->user();

        if ($words->word == $answer) {
            $result = [
                'status' => 'correct',
                'point' => 10
            ];

            $user->point += $result['point'];
            $user->words = ltrim($user->words.','.$words->id, ',');
        } else {
            $result = [
                'status' => 'wrong',
                'point' => -5
            ];

            $user->point += $request['point'];
        }

        $user->save();

        History::create([
            'user_id' => auth()->user()->id,
            'word_id' => $words->id,
            'point' => $result['point']
        ]);

        return response()->json($result);
    }
}
