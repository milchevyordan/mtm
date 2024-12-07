<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8"/>
    <title>{{ __('Отчет') }} {{ $report->id }}</title>

    @include('styles')
</head>

<body>

<div class="container text-s">
    <h1 class="heading">Отчет</h1>

    <table class="w-full pt-1">
        <tr>
            <td class="width-fifteen align-top px-half">
                <div class="pt-half">
                    Отчет №: <span class="fw-bold">{{ $report->id }}</span>
                </div>
                <div class="pt-half">
                    Дата на създаване: <span class="fw-bold">{{ \Carbon\Carbon::parse($report->created_at)->format('d-m-Y, H:i') }}</span>
                </div>
                <div class="pt-half">
                    Създател: {{ $report->creator->name }}
                </div>
            </td>

            {{-- Second column column --}}
            <td class="width-fifteen align-top px-half">
                <div class="pt-half">
                    Дата От: <span class="fw-bold">{{ \Carbon\Carbon::parse($report->date_from)->format('d-m-Y') }}</span>
                </div>

                <div class="pt-half">
                    Дата До: <span class="fw-bold">{{ \Carbon\Carbon::parse($report->date_to)->format('d-m-Y') }}</span>
                </div>
            </td>
        </tr>
    </table>

    <h1 class="heading pt-3">Проекти</h1>

    <table class="w-full pt-1">
        <tr class="border-bottom">
            <th class="text-left py-1">№</th>
            <th class="text-left py-1">Склад</th>
            <th class="text-left py-1">Име</th>
            <th class="text-left py-1">Създаден</th>
        </tr>

        @foreach($report->projects as $project)
            <tr class="border-bottom">
                <td class="py-1">
                    {{ $project->id }}
                </td>

                <td class="py-1">
                    {{ $project->warehouse->name }}
                </td>

                <td class="py-1">
                    {{ $project->name }}
                </td>

                <td class="py-1">
                    {{ \Carbon\Carbon::parse($project->created_at)->format('d-m-Y') }}
                </td>
            </tr>
        @endforeach
    </table>

    <h1 class="heading pt-3">Products</h1>

    <table class="w-full">
        <tr class="border-bottom">
            <th class="text-left py-1">№</th>
            <th class="text-left py-1">Име</th>
            <th class="text-left py-1">Спецификация</th>
            <th class="text-left py-1">Тип</th>
            <th class="text-left py-1">Вътрешен №</th>
            <th class="text-left py-1">Количество</th>
        </tr>


        @foreach($report->products as $product)
            <tr class="border-bottom">
                <td class="py-1">
                    {{ $product->id }}
                </td>

                <td class="py-1">
                    {{ $product->name }}
                </td>

                <td class="py-1">
                    {{ $product->specification }}
                </td>

                <td class="py-1">
                    {{ str_replace('_', ' ', $product->type->name) }}
                </td>

                <td class="py-1">
                    {{ $product->internal_id }}
                </td>


                <td class="py-1 fw-bold">
                    {{ $product->pivot->quantity }}
                </td>
            </tr>
        @endforeach
    </table>
</div>
</body>
</html>