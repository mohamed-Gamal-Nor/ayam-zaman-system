
@foreach ($invoices as $invoice)
<table class="table table-invoice border text-md-nowrap mb-0">
    <thead>
        <tr>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
        </tr>
        <tr>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
        </tr>
        <tr>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
        </tr>
        <tr>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
        </tr>
        <tr>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
        </tr>
        <tr>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
        </tr>
        <tr>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
        </tr>
        <tr>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
        </tr>

        <tr>
            <th colspan="3">فاتورة رقم</th>
            <th colspan="3">{{ $invoice->id }}</th>
        </tr>
        <tr>
            <th colspan="3">كود المورد</th>
            <th colspan="3">{{ $invoice->supplier->id }}</th>
        </tr>
        <tr>
            <th colspan="3">اسم المورد</th>
            <th colspan="3">{{ $invoice->supplier->supplier_name }}</th>
        </tr>
        <tr>
            <th colspan="3">تاريخ الفاتورة</th>
            <th colspan="3">{{ $invoice->invoice_Date }}</th>
        </tr>
        <tr>
            <th colspan="3">المخزن</th>
            <th colspan="3">{{ $invoice->store->stores_name }}</th>
        </tr>
        <tr>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
        </tr>
        <tr class="text-center">
            <th class="wd-5p">#</th>
            <th class="wd-25p">اسم الخامة</th>
            <th class="wd-5p">وحدة القياس</th>
            <th class="wd-5p">الكمية</th>
            <th class="wd-5p">سعر الوحدة</th>
            <th class="wd-5p">المجموع</th>

        </tr>
    </thead>
    <tbody>
        <?php $i=0;?>
        @foreach ($invoice->purches  as $key => $item)
        <?php $i++?>
        <tr class="text-center">
            <td>{{ $i }}</td>
            <td>{{ $item->material->materials_name }}</td>
            <td>{{ $item->material->unit->unit_name}}</td>
            <td>{{ number_format($item->Quantity,2) }}</td>
            <td>{{ number_format($item->price,2) }}</td>
            <td>{{$item->matarial_total}}</td>
        </tr>
        @endforeach
        <tr>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
        </tr>
        <tr>
            <td colspan="3">أجمالي المجموع</td>
            <td colspan="3">{{$invoice->sub_total}}</td>
        </tr>
        <tr>
            <td colspan="3">خصم</td>
            <td colspan="3">-{{$invoice->discount}}</td>
        </tr>
        <tr>
            <td colspan="3">الاجمالي بعد الخصم</td>
            <td colspan="3">{{$invoice->sub_total_disc}}</td>
        </tr>
        <tr>
            <td colspan="3">ضريبة ({{ $invoice->rate_vat * 100 }}%)</td>
            <td colspan="3">{{$invoice->value_vat}}</td>
        </tr>
        <tr>
            <td colspan="3">اجمالي الفاتورة</td>
            <td colspan="3">{{$invoice->total}}</td>
        </tr>
        <tr>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
        </tr>
        <tr>
            <td colspan="3" rowspan="3">ملاحظات علي الفاتورة</td>
            <td colspan="3" rowspan="3">{{$invoice->note}}</td>
        </tr>
    </tbody>
</table>
@endforeach

