<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        @if (app()->getLocale() == 'ar')
        <style>
           body {
            font-family: 'XBRiyaz', sans-serif;
            direction: rtl;
            font-size: 20px;
            height: 100%;
           }
           table{
                width:100%;
                border: 1px solid black;
                border-collapse: collapse;
                margin:auto;
                direction: rtl;
            }
            td,th{
                border: 1px solid black;
                padding-right: 5px;
                width:24%;
                text-align: right;
                font-size: 16px;
            }
            th{
                font-size: 19px;
            }
            caption{
                font-size: 20px;
            }
        </style>
           @else
        <style>
            body {
            font-family: 'XBRiyaz', sans-serif;
            font-size: 12px;
           }
           h5 {
            text-align: center;
            text-decoration: underline;
            font-size: 20px;
            }
            table{
                width:100%;
                height:100%;
                border: 1px solid black;
                border-collapse: collapse;
            }
            td,th{
                border: 1px solid black;
                height:25px;
            }
            td{
                text-align: center;
            }
            th{
                text-align: left;
                font-size: 13px;
                padding-left: 5px;
            }
        </style>
        @endif
    </head>
    <body>
        <table class="table table-bordered">
            <caption style="caption-side: top;text-align:center;font-weight:bold;font-size:30px">{{__('To Do List')}}</caption>
            <thead>
                <tr>
                    <th scope="col" style="width: 10%">{{__('Duration')}}</th>
                    <th scope="col" style="width: 15%">{{__('Title')}}</th>
                    <th scope="col" style="width: 25%">{{__('Description')}}</th>
                    <th scope="col" style="width: 13%">{{__('Assigned From')}}</th>
                    <th scope="col" style="width: 15%">{{__('Status')}}</th>
                    {{-- <th scope="col" style="width: 13%">{{__('Forward to')}}</th> --}}
                    <th scope="col" style="width: 25%">{{__('Due Date')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                <tr>
                    <td>
                        @if(\Carbon\Carbon::now()->diffInDays($task->duedate) <= 0)
                            <small style="background: #ff7676; padding:4px;"><i class="far fa-clock"></i> < 24 {{__('hours')}}</small>
                        @elseif(\Carbon\Carbon::now()->diffInDays($task->duedate) <= 3 and \Carbon\Carbon::now()->diffInDays($task->duedate) > 0)
                        <small style="background: #ffcf76;;padding:4px;"><i class="far fa-clock"></i> {{\Carbon\Carbon::now()->diffInDays($task->duedate)}} {{__('days')}}</small>
                        @else
                        <small style="background: #98FF98;padding:4px;"><i class="far fa-clock"></i> {{\Carbon\Carbon::now()->diffInDays($task->duedate)}} {{__('days')}}</small>
                        @endif
                    </td>
                    <td>{{$task->title}}</td>
                    <td>{{$task->description}}</td>
                    <td>{{ App\Models\User::where(['id' => $task->user_id])->pluck('name')->first()}}</td>
                    <td>
                        {{__($task->status)}}
                    </td>
                    {{-- <td>
                        <option value="{{$user->id}}">{{$user->name}}</option>
                    </td> --}}
                    <td>{{$task->duedate->format('Y-m-d')}}</td>
                 </tr>
                @endforeach
            </tbody>
        </table>


    </body>

</html>

















