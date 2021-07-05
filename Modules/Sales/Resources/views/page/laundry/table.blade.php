<table id="transaction" class="table table-no-more table-bordered table-striped">
    <thead>
        <tr>
            <th class="text-left col-md-1">Hapus Linen</th>
            <th class="text-left col-md-2">Nama Linen</th>
            <th class="text-right col-md-1">Kotor</th>
            <th class="text-right col-md-1">Bersih</th>
            <th class="text-right col-md-2">Catatan</th>
        </tr>
    </thead>
    <tbody class="markup">
        @if(!empty($detail) || old('detail'))
        @foreach (old('detail') ?? $detail as $item)
        <tr>
            <td data-title="ID Product">
                @if(old('detail'))
                <button id="delete" value="{{ $item['temp_id'] }}" type="button" class="btn btn-danger btn-xs btn-block">{{ $item['temp_id'] }}</button>
                @else
                <a id="delete" value="{{ $item->laundry_detail_product_id }}"
                    href="{{ route(config('module').'_delete', ['code' => $item->laundry_detail_id, 'detail' => $item->laundry_detail_product_id ]) }}"
                    class="btn btn-danger btn-xs btn-block delete-{{ $item->laundry_detail_product_id }}">
                    {{ $item->laundry_detail_product_id }}
                </a>
                @endif
                <input type="hidden" class="temp_id" value="{{ $item['temp_id'] ?? $item->laundry_detail_product_id }}" name="temp_id[]">
                <input type="hidden" value="{{ $item['temp_id'] ?? $item->laundry_detail_product_id }}"
                    name="detail[{{ $loop->index }}][temp_id]">
            </td>
            <td data-title="Product">
                <input type="text" class="form-control input-sm"
                    value="{{ $item['temp_product'] ?? $item->laundry_detail_product_name }}" name="detail[{{ $loop->index }}][temp_product]">

            </td>
            <td data-title="Kotor" class="text-right col-lg-1">
                <input type="text" tabindex="{{ $loop->iteration }}1" name="detail[{{ $loop->index }}][temp_qty]"
                    class="form-control input-sm text-right number temp_qty"
                    value="{{ $item['temp_qty'] ?? $item->laundry_detail_kotor }}">
            </td>
            <td data-title="Bersih" class="text-right col-lg-1">
                <input type="text" tabindex="{{ $loop->iteration }}2"  name="detail[{{ $loop->index }}][temp_price]"
                    class="form-control input-sm text-right money temp_price"
                    value="{{ $item['temp_price'] ?? $item->laundry_detail_bersih }}">

            </td>
            <td data-title="Total" class="text-right col-lg-1">
            <textarea rows="2" placeholder="notes" tabindex="{{ $loop->iteration }}5" class="form-control temp_notes" name="detail[{{ $loop->index }}][temp_notes]">{{ $item['temp_notes'] ?? $item->laundry_detail_notes }}</textarea>
            </td>
        </tr>
        @endforeach
        @endisset
    </tbody>
</table>