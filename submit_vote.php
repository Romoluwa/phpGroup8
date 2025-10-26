<!-- SUBMIT_VOTE.PHP -->
<?php
// submit_vote.php - receives POST candidate_id and position_id, returns JSON
session_start();
header('Content-Type: application/json');
require_once 'db.php';

if (!isset($_SESSION['voter_id'])) {
    echo json_encode(['status'=>'error','message'=>'Not authenticated']);
    exit();
}

$voter_id = intval($_SESSION['voter_id']);
$candidate_id = isset($_POST['candidate_id']) ? intval($_POST['candidate_id']) : 0;
$position_id = isset($_POST['position_id']) ? intval($_POST['position_id']) : 0;

if ($candidate_id <= 0 || $position_id <= 0) {
    echo json_encode(['status'=>'error','message'=>'Invalid input']);
    exit();
}

// check if this voter already voted for this position
$chk = $conn->prepare("SELECT COUNT(*) AS c FROM votes WHERE voter_id = ? AND position_id = ?");
$chk->bind_param("ii", $voter_id, $position_id);
$chk->execute();
$res = $chk->get_result()->fetch_assoc();
$chk->close();

if ($res['c'] > 0) {
    echo json_encode(['status'=>'already','message'=>'Already voted for this position']);
    exit();
}

// ensure candidate belongs to the position (extra safety)
$chk2 = $conn->prepare("SELECT COUNT(*) AS c FROM candidates WHERE id = ? AND position_id = ?");
$chk2->bind_param("ii", $candidate_id, $position_id);
$chk2->execute();
$res2 = $chk2->get_result()->fetch_assoc();
$chk2->close();

if ($res2['c'] == 0) {
    echo json_encode(['status'=>'error','message'=>'Candidate does not belong to that position']);
    exit();
}

// insert vote
$ins = $conn->prepare("INSERT INTO votes (voter_id, candidate_id, position_id) VALUES (?, ?, ?)");
$ins->bind_param("iii", $voter_id, $candidate_id, $position_id);
$ok = $ins->execute();
$ins->close();

if ($ok) {
    echo json_encode(['status'=>'ok']);
} else {
    echo json_encode(['status'=>'error','message'=>'DB insert failed']);
}
exit();
