<tr>
    <td>
        {{$model->product_name}}
    <input type="hidden" name="product_item_id[]" class="form-controll product_id" value="{{$model->id}}">
    <input type="hidden" class="form-controll code" id="code_{{$row}}" data-id="{{$row}}" value="{{$model->id}}">
    </td>
    <td>
        <input type="text" name="vehicle_name[]" class="form-control" id="">
    </td>
    <td>
        <input type="text" name="vehicle_no[]" class="form-control" id="">
    </td>
    <td>
    <input type="number" min="0" name="quantity[]" class="form-control qty" id="qty_{{$row}}" value="{{$quantity}}">
    </td>
    <td>
    <input type="number" min="0" name="unit_price[]" class="form-control price" value="{{$model->cost_price}}">
    </td>
    <td>
        <input type="hidden" name="total[]" class="total" value="{{$quantity*$model->cost_price}}">
    <span id="amt_{{$row}}" class="amt">{{$quantity*$model->cost_price}}</span>
    </td>
    <td>
        <button type="button" class="btn btn-info remove">X</button>
    </td>
</tr>