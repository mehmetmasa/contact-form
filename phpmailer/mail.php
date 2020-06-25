<?php
require("class.phpmailer.php");
if ($_POST){
    if (!empty($_POST['name']) || !empty($_POST['email']) || !empty($_POST['message'])){

        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPDebug = 1; // Hata ayıklama değişkeni: 1 = hata ve mesaj gösterir, 2 = sadece mesaj gösterir
        $mail->SMTPAuth = true; //SMTP doğrulama olmalı ve bu değer değişmemeli
        $mail->SMTPSecure = 'tls'; // Normal bağlantı için tls , güvenli bağlantı için ssl yazın
        $mail->Host = "mail.alanadi.com"; // Mail sunucusunun adresi (IP de olabilir)
        $mail->Port = 587; // Normal bağlantı için 587, güvenli bağlantı için 465 yazın
        $mail->IsHTML(true);
        $mail->SetLanguage("tr", "phpmailer/language");
        $mail->CharSet  ="utf-8";
        $mail->Username = "gonderen@alanadi.com"; // Gönderici adresinizin sunucudaki kullanıcı adı (e-posta adresiniz)
        $mail->Password = "PAROLA"; // Mail adresimizin sifresi
        $mail->SetFrom("gonderen@alanadi.com", "Adınız Soyadınız"); // Mail atıldığında gorulecek isim ve email (genelde yukarıdaki username kullanılır)
        $mail->AddAddress("alici@alanadi.com"); // Mailin gönderileceği alıcı adres
        $mail->Subject = "Mesaj Basligi"; // Email konu başlığı
        $mail->Body = "Mesaj icerigi ve metni"; // Mailin içeriği

        if(!$mail->Send()){
            echo "Email Sending Error: ".$mail->ErrorInfo;
           // $data = ['success' => false, 'msg' => 'Email Sending Error: '.$mail->ErrorInfo];
        } else {
            echo "Email Send:";
        }
    }else{
        echo "Do not leave any space.";
        //$data = ['data' => ['success' => false, 'msg' => 'Do not leave any space.']];
        //return json_encode($data);
    }
}