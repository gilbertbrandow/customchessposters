<?php

namespace Database\Seeders;

use App\Models\Poster;
use Illuminate\Database\Seeder;

class PostersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Poster::factory()->count(3)
            ->sequence(
                [
                    'theme' => 1,
                    'orientation' => 1,
                    'starting_position' => 'rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR w KQkq - 0 1',
                    'pgn' => '1. c4 e6 2. Nf3 d5 3. d4 Nf6 4. Nc3 Be7 5. Bg5 O-O 6. e3 h6 7. Bh4 b6 8. cxd5 Nxd5 9. Bxe7 Qxe7 10. Nxd5 exd5 11. Rc1 Be6 12. Qa4 c5 13. Qa3 Rc8 14. Bb5 a6 15. dxc5 bxc5 16. O-O Ra7 17. Be2 Nd7 18. Nd4 Qf8 19. Nxe6 fxe6 20. e4 d4 21. f4 Qe7 22. e5 Rb8 23. Bc4 Kh8 24. Qh3 Nf8 25. b3 a5 26. f5 exf5 27. Rxf5 Nh7 28. Rcf1 Qd8 29. Qg3 Re7 30. h4 Rbb7 31. e6 Rbc7 32. Qe5 Qe8 33. a4 Qd8 34. R1f2 Qe8 35. R2f3 Qd8 36. Bd3 Qe8 37. Qe4 Nf6 38. Rxf6 gxf6 39. Rxf6 Kg8 40. Bc4 Kh8 41. Qf4',
                    'diagram_position' => 1,
                    'move_comment' => 'Shockingly, Fischer opted out of his long term choice 1. e4',
                    'fen' => 'rnbqkbnr/pppppppp/8/8/2P5/8/PP1PPPPP/RNBQKBNR b KQkq - 0 1',
                    'result' => '1-0',
                    'title' => 'The Applause',
                    'white_player' => 'Fischer, Robert James',
                    'black_player' => 'Spassky, Boris V',
                    'white_rating' => 2785,
                    'black_rating' => 2660,
                    'white_title' => 'GM',
                    'black_title' => 'GM',
                    'when' => 'World Championship, 1972 Round 6',
                    'where' => 'Iceland, Reykjavik',
                ],

                [
                    'theme' => 1,
                    'orientation' => 1,
                    'starting_position' => 'rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR w KQkq - 0 1',
                    'pgn' => '1. e4 e5 2. Nf3 Nc6 3. Bb5 a6 4. Ba4 Nf6 5. O-O Nxe4 6. d4 b5 7. Bb3 d5 8. dxe5 Be6 9. Nbd2 Nc5 10. c3 d4 11. Ng5 Bd5 12. Nxf7 Kxf7 13. Qf3+ Ke6 14. Qg4+ Kf7 15. Qf5+ Ke7 16. e6 Bxe6 17. Re1 Qd6 18. Bxe6 Nxe6 19. Ne4 Qe5 20. Bg5+ Kd7 21. Nc5+ Bxc5 22. Qf7+ Kd6 23. Be7+ Kd5',
                    'diagram_position' => 23,
                    'move_comment' => 'Inviting the King for a walk',
                    'fen' => 'r2qkb1r/2p2Npp/p1n5/1pnbP3/3p4/1BP5/PP1N1PPP/R1BQ1RK1 b kq - 0 12',
                    'result' => '1-0',
                    'title' => 'A Queen in Pursuit',
                    'white_player' => 'Polgar, Judit',
                    'black_player' => 'Mamedyarov, Shakhriyar',
                    'white_rating' => 2685,
                    'black_rating' => 2580,
                    'white_title' => 'GM',
                    'black_title' => 'GM',
                    'when' => 'Bled ol (Men), 2002.10.29 Round 4.2',
                    'where' => 'Slovenia, Bled',
                ],

                [
                    'theme' => 1,
                    'orientation' => 1,
                    'starting_position' => 'rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR w KQkq - 0 1',
                    'pgn' => '1. d4 Nf6 2. Nf3 d5 3. Bf4 c5 4. e3 Nc6 5. Nbd2 cxd4 6. exd4 Bf5 7. c3 e6 8. Bb5 Bd6 9. Bxd6 Qxd6 10. O-O O-O 11. Re1 h6 12. Ne5 Ne7 13. a4 a6 14. Bf1 Nd7 15. Nxd7 Qxd7 16. a5 Qc7 17. Qf3 Rfc8 18. Ra3 Bg6 19. Nb3 Nc6 20. Qg3 Qe7 21. h4 Re8 22. Nc5 e5 23. Rb3 Nxa5 24. Rxe5 Qf6 25. Ra3 Nc4 26. Bxc4 dxc4 27. h5 Bc2 28. Nxb7 Qb6 29. Nd6 Rxe5 30. Qxe5 Qxb2 31. Ra5 Kh7 32. Rc5 Qc1+ 33. Kh2 f6 34. Qg3 a5 35. Nxc4 a4 36. Ne3 Bb1 37. Rc7 Rg8 38. Nd5 Kh8 39. Ra7 a3 40. Ne7 Rf8 41. d5 a2 42. Qc7 Kh7 43. Ng6 Rg8 44. Qf7',
                    'diagram_position' => 81,
                    'move_comment' => 'Unassuming, but devastating',
                    'fen' => '5r1k/R3N1p1/5p1p/3P3P/8/p1P3Q1/5PPK/1bq5 b - - 0 41',
                    'result' => '1-0',
                    'title' => 'Casting a deep mating net',
                    'white_player' => 'Liren, Ding',
                    'black_player' => 'Nepomniachtchi, Ian',
                    'white_rating' => 2788,
                    'black_rating' => 2795,
                    'white_title' => 'GM',
                    'black_title' => 'GM',
                    'when' => 'FIDE World Championship 2023, Round 6',
                    'where' => 'Astana, Kazakhstan',
                ],

            )
            ->create();
    }
}
