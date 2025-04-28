@extends('layouts.app')
@section('content')

<div class="container">
    <h2><strong>Articles list</strong></h2>
    @if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif

    <div class="flex-center position-ref full-height">
        <form>
            @csrf
            @method('post')
            <table class="table table-fixed table-striped" id="dict-table">
                <thead>
                    <tr>
                        <th width="15px">#</th>
                        @foreach ($add_th as $i => $value)
                        <th class="col-xs-2" width="{{$th_width[$i]*0.75}}px">
                            <input type="text" name="wanted{{$add_th[$i]}}" class="form-control"
                            value="<?php echo isset($_REQUEST['wanted' . $add_th[$i]]) ? $_REQUEST['wanted' . $add_th[$i]] : '' ?>"
                            placeholder={{$add_th[$i]}}>
                        </th>
                        @endforeach
                        <th class="col-xs-2" width="175px">
                            <div style="float: right; margin-right: 5px;">
                                <button href="#" type="submit" name="search" value="search" id="search" class="btn btn-small btn-outline-primary"> <i class="fa fa-fw fa-search"></i> Find</button>
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($records as $record)
                    <tr>
                        <th width="35px">{{$record->id}} </th>
                        @foreach ($add_td as $i => $value)
                            <td width="{{$th_width[$i]*1.4}}px">{{$record->$value}} </td>
                        @endforeach
                        <td class="col-xs-2 flex">
                            <div style="float: right; margin-right: 2px;">
                                <button class="btn btn-warning btn-block" type="submit" formaction="{{ route('articles.comments', ['article' => $record]) }}" formmethod="post">Show - Comment
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </form>
    </div>
</div>
@endsection
