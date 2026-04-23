<?php 
include("./includes/header.php");
include("./classes/class.user.php");
include("./classes/class.patient.php");

$userObj = new User();
$patientObj = new Patient();

$userData = null;
$reportData = null;

// Check user_id from URL
if (isset($_GET['user_id'])) {
    $user = $userObj->fetchUserById($_GET['user_id']);
    if ($user && count($user) > 0) {
        $userData = $user[0];
        // fetch report only if user exists
        $report = $patientObj->fetchReportById($userData['user_id']);
        if ($report && count($report) > 0) {
            $reportData = $report[0];
        }
    }
}
?>

<div class="container mt-5">

    <!-- Patient Details -->
    <div class="patient-details">
        <h2 class="mb-4">Patient Details</h2>

        <?php if ($userData) { ?>
            <div class="detail-item">
                <strong>User ID:</strong>
                <span><?php echo htmlspecialchars($userData['user_id']); ?></span>
            </div>
            <div class="detail-item">
                <strong>User Name:</strong>
                <span><?php echo htmlspecialchars($userData['user_name']); ?></span>
            </div>
            <div class="detail-item">
                <strong>Phone Number:</strong>
                <span><?php echo htmlspecialchars($userData['user_phone']); ?></span>
            </div>
        <?php } else { ?>
            <div class="alert alert-danger">No patient found. Please check the User ID.</div>
        <?php } ?>
    </div>

    <!-- Test Report -->
    <div class="test-report">
        <h3 class="mb-4">Test Report</h3>

        <?php if ($reportData) { ?>
            <div class="detail-item"><strong>Heart Rate:</strong> <span><?php echo $reportData['heart_rate']; ?> bpm</span></div>
            <div class="detail-item"><strong>Blood Pressure:</strong> <span><?php echo $reportData['blood_pressure']; ?> mmHg</span></div>
            <div class="detail-item"><strong>Respiratory Rate:</strong> <span><?php echo $reportData['respiratory_rate']; ?> breaths/min</span></div>
            <div class="detail-item"><strong>Oxygen Saturation (SpO2):</strong> <span><?php echo $reportData['oxygen_saturation']; ?>%</span></div>
            <div class="detail-item"><strong>Body Temperature:</strong> <span><?php echo $reportData['body_temperature']; ?> °F</span></div>
            <div class="detail-item"><strong>Blood Glucose Level (Diabetic Rate):</strong> <span><?php echo $reportData['glucose_level']; ?> mg/dL</span></div>
            <div class="detail-item"><strong>Body Mass Index (BMI):</strong> <span><?php echo $reportData['bmi']; ?></span></div>
            <div class="detail-item"><strong>Cholesterol Levels:</strong> <span><?php echo $reportData['cholesterol_level']; ?> mg/dL</span></div>
            <div class="detail-item"><strong>Hemoglobin Levels:</strong> <span><?php echo $reportData['hemoglobin_level']; ?> g/dL</span></div>
            <div class="detail-item"><strong>Pain Scale (e.g., 1-10):</strong> <span><?php echo $reportData['pain_scale']; ?></span></div>
        <?php } else { ?>
            <div class="alert alert-warning">No test report available for this patient.</div>
        <?php } ?>
    </div>
</div>

<?php include("./includes/footer.php") ?>
