<?php
if (!isset($_SESSION)) {
    session_start();
}

include './assets/connection.php';

if ($_SESSION['user_name']) {
    $user = $_SESSION['user_name'];
    $email = $_SESSION['email'];
    $id = $_SESSION['bidder_id'];
} else {
    header("Location: ./login.php");
}

$user_bid = mysqli_query($db, "SELECT * FROM BIDDING WHERE BIDDING_BIDDER_ID = $id ORDER BY BIDDING_ID DESC LIMIT 1");
$bid = mysqli_fetch_assoc($user_bid);

$tender_id = $bid['BIDDING_TENDER_ID'];
$tender_bidded = mysqli_query($db, "SELECT * FROM TENDER WHERE TENDER_ID = $tender_id");
$tender = mysqli_fetch_assoc($tender_bidded);

include './includes/header.php';
?>

<main>
    <section class="intro-section" style="height: 30vh;">
        <div class="intro-section-content">
            <h2>Most recent bid placed.</h2>
            <div class="navigation">
                <h3><a href="./bidder.php">Dashboard</a>
            </div>
        </div>
    </section>
    
    <section class='report-container'>
        <h1>Bid placed</h1>
        <hr>
        <div class="report">
            <table>
                <tr>
                    <td class='table-data'>Tender bidded</td>
                    <td style='text-transform:capitalize;'><?php echo $tender['TENDER_NAME'];?></td>
                </tr>
                <tr>
                    <td class='table-data'>Tender description</td>
                    <td><?php echo $tender['TENDER_DESC'];?></td>
                </tr>
                <tr>
                    <td class='table-data'>Cover letter submitted</td>
                    <td><?php echo $bid['BIDDING_DESC'];?></td>
                </tr>
                <tr>
                    <td class='table-data'>Price bidded</td>
                    <td style='font-weight:bold;'><?php echo "<span>".$bid['BIDDING_TOTAL_COST']."</span>";?></td>
                </tr>
            </table>
        </div>
        <div class="print">
            <a target="_blank" onClick="window.print()">Print Report</a>
        </div>
    </section>
</main>