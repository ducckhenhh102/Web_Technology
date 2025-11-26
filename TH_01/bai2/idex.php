<?php
$jsonFile = 'questions.json';
$questions = [];

if (file_exists($jsonFile)) {
    $jsonData = file_get_contents($jsonFile);
    $questions = json_decode($jsonData, true);
} else {
    die("Chưa có file questions.json");
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trắc nghiệm Android</title>
    <style>
        body { font-family: sans-serif; max-width: 800px; margin: 20px auto; line-height: 1.5; }
        .question-item { margin-bottom: 30px; border-bottom: 1px solid #ccc; padding-bottom: 20px; }
        .question-text { font-weight: bold; margin-bottom: 10px; font-size: 1.1em; }
        .option { margin: 5px 0; cursor: pointer; display: block; }
        
        /* CSS cho nút hiện đáp án */
        .check-btn { margin-top: 10px; padding: 5px 10px; cursor: pointer; }
        
        /* Màu sắc kết quả (mặc định ẩn) */
        .result-msg { display: none; font-weight: bold; margin-top: 5px; }
        .correct { color: green; }
        .incorrect { color: red; }
        .correct-answer-text { color: blue; font-style: italic; display: none; margin-top: 5px;}
    </style>
</head>
<body>

    <h1>Bài tập trắc nghiệm</h1>

    <?php foreach ($questions as $index => $q): ?>
        <div class="question-item" id="q-<?php echo $index; ?>">
            <div class="question-text">
                Câu <?php echo $index + 1; ?>: <?php echo htmlspecialchars($q['question']); ?>
            </div>

            <?php 
            // Chuyển mảng đáp án đúng thành chuỗi JSON để JS xử lý
            $correctJson = json_encode($q['answer']); 
            $inputType = count($q['answer']) > 1 ? 'checkbox' : 'radio';
            ?>

            <!-- Form chọn đáp án -->
            <div class="options-container">
                <?php foreach ($q['options'] as $key => $val): ?>
                    <label class="option">
                        <input type="<?php echo $inputType; ?>" 
                               name="q<?php echo $index; ?>" 
                               value="<?php echo $key; ?>">
                        <?php echo $key; ?>. <?php echo htmlspecialchars($val); ?>
                    </label>
                <?php endforeach; ?>
            </div>

            <!-- Nút kiểm tra cho từng câu -->
            <button class="check-btn" onclick='checkAnswer(<?php echo $index; ?>, <?php echo $correctJson; ?>)'>
                Xem đáp án
            </button>
            
            <!-- Khu vực hiện kết quả -->
            <div id="result-<?php echo $index; ?>" class="result-msg"></div>
            <div id="answer-text-<?php echo $index; ?>" class="correct-answer-text">
                Đáp án đúng: <?php echo implode(", ", $q['answer']); ?>
            </div>
        </div>
    <?php endforeach; ?>

    <script>
        function checkAnswer(questionIndex, correctAnswers) {
            // 1. Lấy tất cả input của câu hỏi này
            const container = document.getElementById('q-' + questionIndex);
            const inputs = container.querySelectorAll('input');
            const resultMsg = document.getElementById('result-' + questionIndex);
            const answerText = document.getElementById('answer-text-' + questionIndex);
            
            // 2. Tìm các đáp án user đã chọn
            let userSelected = [];
            inputs.forEach(input => {
                if (input.checked) {
                    userSelected.push(input.value);
                }
            });

            // 3. So sánh (Cần sort để so sánh mảng chính xác)
            userSelected.sort();
            correctAnswers.sort();

            // Chuyển về chuỗi để so sánh cho dễ
            const isCorrect = JSON.stringify(userSelected) === JSON.stringify(correctAnswers);

            // 4. Hiển thị thông báo
            resultMsg.style.display = 'block';
            answerText.style.display = 'block';
            
            if (isCorrect) {
                resultMsg.innerText = "Chính xác! ✅";
                resultMsg.className = "result-msg correct";
            } else {
                resultMsg.innerText = "Sai rồi! ❌";
                resultMsg.className = "result-msg incorrect";
            }
        }
    </script>

</body>
</html>