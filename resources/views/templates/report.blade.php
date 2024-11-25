<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8"/>
    <title>{{ __('Report') }} {{ $report->id }}</title>

    @include('styles')
</head>

<body>
<div class="header-report w-full">
    <div class="container">
        <div>
            <h1 class="heading mb-1">{{ __('Report') }}</h1>
        </div>

        <div>
            <span>User Created Pdf: {{ auth()->user()->name }}</span>
        </div>
        <div class="mb-1">
            <span>Date Pdf Created: {{ \Carbon\Carbon::now()->format('d-m-Y, H:i') }}</span>
        </div>
        <div>
            <span>User Created Report: {{ $report->creator->name }}</span>
        </div>
        <div>
            <span>Date Report Created: {{ \Carbon\Carbon::parse($report->created_at)->format('d-m-Y, H:i') }}</span>
        </div>
        <div>
            <span>Report nr: {{ $report->id }}</span>
        </div>

    </div>
</div>
{{--{{dd(1)}}--}}

<div class="container">
    <div class="pt-3">
        Please find the report details below:
    </div>

    <table class="pt-2">
        <tr>
            <td class="p-half text-s">Projects:</td>
            <td class="p-half text-lg fw-bold">
                @foreach($report->projects as $project)
                    <div>
                        {{ $project->name }}
                    </div>
                @endforeach
            </td>
        </tr>

        <tr>
            <td class="p-half text-s">Products:</td>
            <td class="p-half text-lg fw-bold">
                @foreach($report->products as $product)
                    <div>
                        {{ $product->name }}
                    </div>
                @endforeach
            </td>
        </tr>
    </table>
</div>

</body>
</html>
