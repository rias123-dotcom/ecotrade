@extends('layouts.app')

@section('content')
<div class="p-6">
    <h2 class="text-2xl font-bold mb-4">Trade Transactions</h2>

    <table class="table-auto w-full border-collapse">
        <thead>
            <tr class="bg-gray-200 text-left">
                <th class="p-2">#</th>
                <th class="p-2">Trader 1</th>
                <th class="p-2">Trader 2</th>
                <th class="p-2">Item Offered</th>
                <th class="p-2">Item Requested</th>
                <th class="p-2">Fraud Risk</th>
                <th class="p-2">T1 Score</th>
                <th class="p-2">T2 Score</th>
                <th class="p-2">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($trades as $trade)
                <tr class="border-t">
                    <td class="p-2">{{ $trade->id }}</td>
                    <td class="p-2">{{ $trade->trader1_id }}</td>
                    <td class="p-2">{{ $trade->trader2_id }}</td>
                    <td class="p-2">{{ $trade->item_offered }}</td>
                    <td class="p-2">{{ $trade->item_requested }}</td>
                    <td class="p-2 text-{{ strtolower($trade->fraud_risk) == 'high' ? 'red-600' : 'green-600' }}">
                        {{ $trade->fraud_risk }}
                    </td>
                    <td class="p-2">{{ $trade->trader1_score }}</td>
                    <td class="p-2">{{ $trade->trader2_score }}</td>
                    <td class="p-2">{{ ucfirst($trade->status) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
