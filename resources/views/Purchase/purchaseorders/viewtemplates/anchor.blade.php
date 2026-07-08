<table class="table table-bordered">

    <thead class="table-dark">

        <tr>

            <th>Material</th>

            <th>Dia</th>

            <th>Length</th>

            <th>Nos</th>

            <th>Rate</th>

            <th>Amount</th>

        </tr>

    </thead>

    <tbody>

        @foreach ($po->items as $item)
            <tr>

                <td>{{ $item->material }}</td>

                <td>{{ $item->dia }}</td>

                <td>{{ $item->length }}</td>

                <td>{{ $item->nos }}</td>

                <td>{{ number_format($item->rate, 2) }}</td>

                <td>{{ number_format($item->amount, 2) }}</td>

            </tr>
        @endforeach

    </tbody>

</table>
