<?php
$host = "13.51.233.66";
$user = "b2212";
$pass = "12345";
$db   = "wordpress_db";
try {
    // Kapsam (scope) hatasını önlemek için bağlantıyı burada tazeleyelim
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "<div style='color:red; border:1px solid red; padding:10px;'>Bağlantı Hatası: " . $e->getMessage() . "</div>";
} ?>
<style>
    .crud-box { max-width: 900px; margin: 0 auto; font-family: sans-serif; }
    .crud-table { width: 100%; border-collapse: collapse; margin-top: 15px; }
    .crud-table th, .crud-table td { border: 1px solid #ddd; padding: 10px; text-align: left; }
    .crud-table th { background: #4CAF50; color: white; }
    .btn { padding: 6px 12px; border: none; cursor: pointer; border-radius: 4px; color: white; text-decoration: none; d>
    .btn-sil { background: #f44336; }
    .btn-guncelle { background: #2196F3; }
</style>
<div class="crud-box">
    <h2>🚀 Kullanıcı Yönetimi</h2>
<?php
// SİL
if (isset($_POST['sil_id'])) {
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
    $stmt->execute([$_POST['sil_id']]);
    header("Location:" . $_SERVER['REQUEST_URI']);
    exit;
}
if (isset($_POST['ekle_btn'])) {
        $stmt = $pdo->prepare("INSERT INTO users (name, email) VALUES (?, ?)");
        $stmt->execute([$_POST['u_name'], $_POST['u_email']]);
        echo "<p style='color:green;'>Kullanıcı eklendi.</p>";
    }
// GÜNCELLE
// --- GÜNCELLEME İŞLEMİ ---
if (isset($_POST['guncelle_btn'])) {
    try {
        $u_id    = $_POST['u_id'];
        $u_name  = $_POST['u_name'];
        $u_email = $_POST['u_email'];
// $db_type kontrolüne gerek yok, doğrudan yukarıda kurduğumuz $pdo'yu kullanıyoruz
        $stmt = $pdo->prepare("UPDATE users SET name=?, email=? WHERE id=?");
        $stmt->execute([$u_name, $u_email, $u_id]);
  echo "<p style='color:blue; font-weight:bold;'>✏️ Kullanıcı başarıyla güncellendi!</p>";
    } catch (Exception $e) {
        echo "<p style='color:red;'>Hata: " . $e->getMessage() . "</p>";
    }
} </tr>
        <?php endforeach; ?>
    </table>
    <div id="duzenle_alani" style="display:none; background:#e3f2fd; padding:15px; border-radius:5px; margin-top:20px; >
        <h3>Kullanıcıyı Güncelle</h3>
        <form method="POST" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
<input type="hidden" name="u_id" id="edit_id">
            <div style="margin-bottom:10px;">
                <label>Ad Soyad:</label><br>
                <input type="text" name="u_name" id="edit_name" required style="padding:8px; margin-right:5px;">
            </div>
            <div style="margin-bottom:10px;">
                <label>E-posta:</label><br>
                <input type="email" name="u_email" id="edit_email" required style="padding:8px; margin-right:5px;">
           </div>
 <button type="submit" name="guncelle_btn" class="btn" style="background:#2196F3;">Değişiklikleri Kaydet</bu>
            <button type="button" onclick="document.getElementById('duzenle_alani').style.display='none'" class="btn" s>
        </form>
    </div>
</div>
<div id="read_modal" style="display:none; position:fixed; top:50%; left:50%; transform:translate(-50%, -50%); backgroun>
    <h3 style="color:#ff9800; margin-top:0;">👤 Kullanıcı Bilgi Kartı</h3>
    <p><strong>ID:</strong> <span id="read_id"></span></p>
    <p><strong>İsim:</strong> <span id="read_name"></span></p>
    <p><strong>E-posta:</strong> <span id="read_email"></span></p>
    <button onclick="document.getElementById('read_modal').style.display='none'" class="btn" style="background:#666; co>
</div>
<script>
// Tablodaki verileri alıp alttaki gizli forma yerleştirir
function duzenleFormunuAc(id, name, email) {
    document.getElementById('duzenle_alani').style.display = 'block';
    document.getElementById('edit_id').value = id;
    document.getElementById('edit_name').value = name;
    document.getElementById('edit_email').value = email;
   // Sayfayı forma doğru kaydır
    document.getElementById('duzenle_alani').scrollIntoView({ behavior: 'smooth' });
}
function kullaniciOku(id, name, email) {
    document.getElementById('read_modal').style.display = 'block';
    document.getElementById('read_id').innerText = id;
    document.getElementById('read_name').innerText = name;
    document.getElementById('read_email').innerText = email;
}
</script>


