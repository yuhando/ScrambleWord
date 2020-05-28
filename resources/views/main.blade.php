@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div style="float: left;margin-top: 10px;margin-left: 17px;">
                        <h2>
                            <label for="category">Category -&nbsp;</label><span id="category"></span>
                        </h2>
                    </div>
                    <div style="float: right;">
                        <h5>
                            <a href="#" class="btn btn-lg">Score</a>
                            <a href="#" class="btn btn-outline-secondary">
                                <span id="score">{{ auth()->user()->point ?? 0 }}</span>
                            </a>    
                            <a href="#" class="btn btn-lg">Words</a>
                            <a href="#" class="btn btn-outline-secondary">
                                <span id="word_number">{{ auth()->user()->words_count ?? 0 }}</span>
                            </a>
                        </h5>
                    </div>
                </div>
                <div class="card-header">
                    <span class="notification"></span>
                    <div class="section-answer"></div>
                </div>
                <div class="card-body">
                    <div class="section-question"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection