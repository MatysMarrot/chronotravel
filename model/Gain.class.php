<?php
class  Gain{
    //Coins gagnés suivant la position
    private array $sum = [
        "1" => 100,
        "2" => 75,
        "3" => 50,
        "4" => 35,
    ];

    /**
     * @param array $studentsPosition La position des joueurs
     * @return void
     * Calculer les gains des joueurs en fonction du classement
     */
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