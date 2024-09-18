<form method="post" action="{{ route('estimate.store') }}">
    @csrf
    <table>
      <tr>
        <th>お客様名</th>
        <td>
          <input id="customer_name" type="text" name="customer_name">
        </td>
      </tr>
      <tr>
        <th>担当者名</th>
        <td>
          <input id="charger_name" type="text" name="charger_name">
        </td>
      </tr>
      <tr>
        <th>件名</th>
        <td>
          <input id="subject_name" type="text" name="subject_name">
        </td>
      </tr>
      <tr>
        <th>納入場所</th>
        <td>
          <input id="delivery_place" type="text" name="delivery_place">
        </td>
      </tr>
      <tr>
        <th>工期</th>
        <td>
          <input id="construction_period" type="text" name="construction_period">
        </td>
      </tr>
      <tr>
        <th>支払方法</th>
        <td>
        <select id="payment_type" name="payment_type">
          <option>現金</option>
          <option>信販</option>
        </select>
        </td>
      </tr>
      <tr>
        <th>有効期限</th>
        <td>
          <input id="expiration_date" type="text" name="expiration_date">
        </td>
      </tr>
      <tr>
        <th>備考</th>
        <td>
          <textarea id="remarks" type="text" name="remarks"></textarea>
        </td>
      </tr>
      <tr>
        <th>部署名</th>
        <td>
          <input id="department_name" type="text" name="department_name">
        </td>
      </tr>
      <tr>
        <th>工事名</th>
        <td>
          <select id="construction_name" type="text" name="construction_name">
            @foreach($construction_name as $construction)
              <option value={{ $construction ->id }}>{{ $construction ->construction_name }}</option>
            @endforeach
          </select>
        </td>
      </tr>
    </table>

    <button type="submit">PDF</button>
</form>
