<?php
// 簡單的作業頁面：顯示作業說明、範例學習目標，並可提交個人目標保存於 submissions.txt
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$name = trim($_POST['name'] ?? '');
		$goals = trim($_POST['goals'] ?? '');
		$timestamp = date('Y-m-d H:i:s');
		if ($goals !== '') {
				$entry = "---\nTime: $timestamp\nName: " . ($name === '' ? '匿名' : $name) . "\nGoals:\n$goals\n";
				file_put_contents(__DIR__ . '/submissions.txt', $entry, FILE_APPEND | LOCK_EX);
				$saved = true;
		}
}
?>
<!doctype html>
<html lang="zh-Hant">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>多媒體程式設計 — 作業提交</title>
	<style>
		body{font-family: -apple-system,BlinkMacSystemFont,Segoe UI,Roboto,'Helvetica Neue',Arial;max-width:900px;margin:28px auto;padding:0 20px;color:#222}
		header h1{margin:0 0 6px}
		.card{background:#fff;border:1px solid #e6e6e6;padding:18px;border-radius:8px;box-shadow:0 1px 0 rgba(0,0,0,0.02)}
		textarea{width:100%;min-height:140px}
		input[type=text]{width:100%;padding:8px}
		.ok{background:#e6ffed;border:1px solid #b7f0c9;padding:12px;margin-bottom:12px;border-radius:6px}
	</style>
</head>
<body>
	<header>
		<h1>多媒體程式設計 — 學習目標作業</h1>
		<p>請輸入你學習多媒體程式設計的目標，提交後會儲存在伺服器上的 `submissions.txt`（僅作示範）。</p>
	</header>

	<section class="card">
		<h2>作業說明</h2>
		<p>請寫出你學習多媒體程式設計（Multimedia Programming）的至少 3 項具體目標，建議每項目標簡短且可衡量。</p>
		<h3>範例目標</h3>
		<ul>
			<li>掌握影像與音訊基礎處理（讀、寫、轉檔、簡單編碼）。</li>
			<li>能使用 HTML5 Canvas 或 WebGL 繪製互動式多媒體內容。</li>
			<li>了解媒體同步（影像與音訊）與延遲處理技巧。</li>
		</ul>
	</section>

	<section style="margin-top:16px" class="card">
		<h2>提交你的目標</h2>
		<?php if (!empty($saved)): ?>
			<div class="ok">已儲存你的目標，感謝提交！</div>
		<?php endif; ?>
		<form method="post">
			<label>姓名（選填）：<input type="text" name="name" value="<?php echo htmlspecialchars($name ?? '', ENT_QUOTES); ?>"></label>
			<p>請在下方輸入你的學習目標，每項一行：</p>
			<textarea name="goals"><?php echo htmlspecialchars($goals ?? '', ENT_QUOTES); ?></textarea>
			<p><button type="submit">提交作業</button></p>
		</form>
		<details>
			<summary>說明</summary>
			<p>提交的內容會追加到專案資料夾內的 `submissions.txt` 檔案。這個範例適合在本機或受信任的教學伺服器上使用。</p>
		</details>
	</section>

	<footer style="margin-top:18px;color:#666;font-size:0.95em">
		<p>檔案：index.php — 若要查看所有提交，可開啟專案中的 <strong>submissions.txt</strong></p>
	</footer>
</body>
</html>

