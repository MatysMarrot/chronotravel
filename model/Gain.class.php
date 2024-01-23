<?php
class Gain{
    private array $sum = [
        "1" => 100,
        "2" => 75,
        "3" => 50,
        "4" => 35,
    ];

    public function calculateGainsByClassement(array &$studentsPosition): void
    {
        //Grouper les étudiants par classement
        $groupedStudents = [];
        foreach ($studentsPosition as $id => $student) {
            $classement = $student['classement'];
            $groupedStudents[$classement][] = $id;
        }

        //Calculer les gains pour chaque classement
        foreach ($groupedStudents as $classement => $ids) {
            $totalGain = 0;
            foreach ($ids as $id) {
                $totalGain += $this->sum[$studentsPosition[$id]['gain']];
            }
            $averageGain = (count($ids) > 0) ? $totalGain / count($ids) : 0;
            foreach ($ids as $id) {
                $studentsPosition[$id]['gain'] = $averageGain;
            }
        }
    }
};
?>