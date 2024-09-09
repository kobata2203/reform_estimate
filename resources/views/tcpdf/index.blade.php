<form method="post" action="{{ route('estimate.store') }}" target="_blank">
    @csrf
    <table>
      <tr>
        <th>お客様名</th>
        <td>
          <input type="text" name="customer_name" value="山田太郎">
        </td>
      </tr>
      <tr>
        <th>金額</th>
        <td>
          ￥<input type="text" name="price" value="1320000">
        </td>
      </tr>
      <tr>
        <th>担当者名</th>
        <td>
          <input type="text" name="charger_name" value="田中花子">
        </td>
      </tr>
      <tr>
        <th>件名</th>
        <td>
          <input type="text" name="subject_name" value="山田太郎邸　浴室改修工事">
        </td>
      </tr>
      <tr>
        <th>納入場所</th>
        <td>
          <input type="text" name="delivery_place" value="大阪府堺市北区●●町○ー○○">
        </td>
      </tr>
      <tr>
        <th>工期</th>
        <td>
          <input type="text" name="construction_period" value="約2週間">
        </td>
      </tr>
      <tr>
        <th>支払方法</th>
        <td>
        <select name="payment_type">
          <option>現金</option>
          <option>信販</option>
        </select>
        </td>
      </tr>
    </table>

    <button type="submit">PDF</button>
</form>
<form method="post" action="breakdown-pdf.php" target="_blank">
    <table>
      <tr>
        <th>No.</th>
        <td>
          <input type="text" name="number" value="0001">
        </td>
      </tr>
      <tr>
        <th>名前</th>
        <td>
          <input type="text" name="name" value="山田太郎">
        </td>
      </tr>
      <tr>
        <th>金額</th>
        <td>
          <input type="text" name="price" value="50000">
        </td>
      </tr>
      <tr>
        <th>但し書き</th>
        <td>
          <input type="text" name="proviso" value="お品代として">
        </td>
      </tr>
    </table>

    <button type="submit">PDF</button>
</form>
