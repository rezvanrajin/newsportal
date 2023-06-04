@extends('frontend.master')

@section('content')


<div class="page-top">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2>{{PREVIEWS_POLL}}</h2>
                        <nav class="breadcrumb-container">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('Home')}}">{{HOME}}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{PREVIEWS_POLL}}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="page-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
            
                        @foreach ($pool as $item)
                            
                      @if($loop->iteration == 1)
                        @continue
                        @endif
                        @php
                           $total_vote = $item->yes+$item->no;
                           if($item->yes == 0)
    {
        $total_yes_percentage = 0;
    }
    else {
        $total_yes_percentage = ($item->yes*100)/$total_vote;
        $total_yes_percentage = ceil($total_yes_percentage);
    }
    if ($item->no == 0) {
        $total_no_percentage = 0;
    }
else {
    $total_no_percentage = ($item->no*100)/$total_vote;
        $total_no_percentage = ceil($total_no_percentage);
}
                        @endphp
                        <div class="poll-item">
                            <div class="question">
                                {!!$item->question!!}
                            </div>
                            <div class="poll-date">
                                <b>{{POLL_DATE}}:</b>{{$item->created_at}}
                            </div>
                            <div class="total-vote">
                                <b>{{TOTAL_VOTES}}:</b> {{$total_vote}}
                            </div>
                            <div class="poll-result">                        
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tr>
                                            <td>{{YES}} ({{$item->yes}})</td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar bg-success" role="progressbar" style="width: {{$total_yes_percentage}}%" aria-valuenow="{{$total_yes_percentage}}" aria-valuemin="0" aria-valuemax="100">{{$total_yes_percentage}}%</div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>{{NO}} ({{$item->no}})</td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar bg-danger" role="progressbar" style="width: {{$total_no_percentage}}%" aria-valuenow="{{$total_no_percentage}}" aria-valuemin="0" aria-valuemax="100">{{$total_no_percentage}}%</div>
                                                </div>
                                            </td>
                                        </tr>
                
                                    </table>
                                </div>
                            </div>
                        </div>

                        @endforeach
                    </div>
                </div>
            </div>
        </div>
@endsection 