<!-- Header Template untuk Semua Export PDF -->
<div style="text-align: center; margin-bottom: 20px; border-bottom: 3px solid #047d78; padding-bottom: 15px;">
    <h1 style="color: #047d78; margin: 0; font-size: 18px;">SISTEM MONITORING KESEHATAN E-ASFARM</h1>
    <h2 style="color: #047d78; margin: 5px 0; font-size: 16px;"><?= $title ?></h2>
    <?php if (isset($subtitle)): ?>
    <h3 style="color: #666; margin: 5px 0; font-size: 13px;"><?= $subtitle ?></h3>
    <?php endif; ?>
</div>

<div style="background-color: #f9f9f9; padding: 12px; margin-bottom: 20px; border-radius: 5px; font-size: 11px;">
    <table style="width: 100%; border: none;">
        <tr>
            <td style="width: 25%; font-weight: bold; border: none; padding: 3px 0;">Padukuhan</td>
            <td style="width: 25%; border: none; padding: 3px 0;">: <?= esc($adminPadukuhan ?? '-') ?></td>
            <td style="width: 25%; font-weight: bold; border: none; padding: 3px 0;">Dicetak oleh</td>
            <td style="width: 25%; border: none; padding: 3px 0;">: <?= esc($adminName ?? session()->get('username')) ?></td>
        </tr>
        <tr>
            <td style="font-weight: bold; border: none; padding: 3px 0;">No. HP Admin</td>
            <td style="border: none; padding: 3px 0;">: <?= esc($adminPhone ?? '-') ?></td>
            <td style="font-weight: bold; border: none; padding: 3px 0;">Tanggal Cetak</td>
            <td style="border: none; padding: 3px 0;">: <?= date('d/m/Y H:i:s') ?></td>
        </tr>
    </table>
</div>
