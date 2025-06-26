<?php
require_once('conexao.php');

$carrinho = [
    ["item" => "Camiseta", "quantidade" => 2, "preco_unitario" => 49.90],
    ["item" => "Calça Jeans", "quantidade" => 1, "preco_unitario" => 129.90],
    ["item" => "Meia", "quantidade" => 5, "preco_unitario" => 9.99],
    ["item" => "Tênis", "quantidade" => 1, "preco_unitario" => 299.90],
];

$total_compra = 0;
$itens_com_desconto = 0;

echo "<h2>Carrinho:</h2>";
echo "<table>
        <tr>
            <th>Item</th>
            <th>Quantidade</th>
            <th>Preço Unitário</th>
            <th>Subtotal</th>
        </tr>";

foreach ($carrinho as $produto) {
    $item = $produto["item"];
    $quantidade = $produto["quantidade"];
    $preco = $produto["preco_unitario"];
    $subtotal = $quantidade * $preco;

    if ($quantidade > 1 && $preco > 50) {
        $subtotal *= 0.90; 
        $itens_com_desconto++;
    }

    $sql = "INSERT INTO itens_carrinho (item, quantidade, preco_unitario, subtotal)
            VALUES ('$item', $quantidade, $preco, $subtotal)";
    
    if (!mysqli_query($conexao, $sql)) {
        echo "Erro ao inserir no banco: " . mysqli_error($conexao);
    }

    $total_compra += $subtotal;

    echo "<tr>
            <td>$item</td>
            <td>$quantidade</td>
            <td>R\$ " . number_format($preco, 2, ',', '.') . "</td>
            <td>R\$ " . number_format($subtotal, 2, ',', '.') . "</td>
        </tr>";
}

echo "</table>";

if ($itens_com_desconto >= 2) {
    $total_compra *= 0.95;
}

echo "<p>Total da Compra: R\$ " . number_format($total_compra, 2, ',', '.') . "</p>";

mysqli_close($conexao);
?>
