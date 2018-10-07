<?php

        include "../../../lib/connection.php";

        $sqlpesan = mysqli_query($conn, "SELECT * FROM tbl_pesan ORDER BY id_pesan DESC");
        while($tampil = mysqli_fetch_array($sqlpesan)) {

    ?>
    <?php if ($tampil['role'] == 1) { ?>
    <div class="direct-chat-msg">
        <div class="direct-chat-info clearfix">
        <span class="direct-chat-name pull-left"><?= $tampil['nama'] ?></span>
        <span class="direct-chat-timestamp pull-right"><?= $tampil['date_in'] ?></span>
        </div>
        <img class="direct-chat-img" src="../components/src/dist/img/chatbot.png" alt="message user image">
        <div class="direct-chat-text">
        <?= $tampil['pesan'] ?>
        </div>
    </div>

    <?php } else { ?>

    <div class="direct-chat-msg right">
        <div class="direct-chat-info clearfix">
        <span class="direct-chat-name pull-right"><?= $tampil['nama'] ?></span>
        <span class="direct-chat-timestamp pull-left"><?= $tampil['date_in'] ?></span>
        </div>
        <img class="direct-chat-img" src="../components/src/dist/img/people.png" alt="message user image">
        <div class="direct-chat-text">
        <?= $tampil['pesan'] ?>
        </div>
    </div>

<?php }} ?>