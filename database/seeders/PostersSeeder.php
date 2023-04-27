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

        Poster::factory()->count(9)
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
                    'title' => 'Casting a Deep Mating Net',
                    'white_player' => 'Liren, Ding',
                    'black_player' => 'Nepomniachtchi, Ian',
                    'white_rating' => 2788,
                    'black_rating' => 2795,
                    'white_title' => 'GM',
                    'black_title' => 'GM',
                    'when' => 'FIDE World Championship 2023, Round 6',
                    'where' => 'Astana, Kazakhstan',
                ],

                [
                    'theme' => 1,
                    'orientation' => 0,
                    'starting_position' => 'rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR w KQkq - 0 1',
                    'pgn' => '1. c4 Nf6 2. Nf3 g6 3. g3 Bg7 4. Bg2 O-O 5. d4 d6 6. Nc3 Nbd7 7. O-O e5 8. e4 c6 9. h3 Qb6 10. d5 cxd5 11. cxd5 Nc5 12. Ne1 Bd7 13. Nd3 Nxd3 14. Qxd3 Rfc8 15. Rb1 Nh5 16. Be3 Qb4 17. Qe2 Rc4 18. Rfc1 Rac8 19. Kh2 f5 20. exf5 Bxf5 21. Ra1 Nf4 22. gxf4 exf4 23. Bd2 Qxb2 24. Rab1 f3 25. Rxb2 fxe2 26. Rb3 Rd4 27. Be1 Be5+ 28. Kg1 Bf4 29. Nxe2 Rxc1 30. Nxd4 Rxe1+ 31. Bf1 Be4 32. Ne2 Be5 33. f4 Bf6 34. Rxb7 Bxd5 35. Rc7 Bxa2 36. Rxa7 Bc4 37. Ra8+ Kf7 38. Ra7+ Ke6 39. Ra3 d5 40. Kf2 Bh4+ 41. Kg2 Kd6 42. Ng3 Bxg3 43. Bxc4 dxc4 44. Kxg3 Kd5 45. Ra7 c3 46. Rc7 Kd4 47. Rd7+',
                    'diagram_position' => 42,
                    'move_comment' => 'The crowd became so excited, the game had to be continued behind closed doors',
                    'fen' => '2r3k1/pp4bp/3p2p1/3Ppb2/1qr2n2/2N1B1PP/PP2QPBK/R1R5 w - - 2 22',
                    'result' => '0-1',
                    'title' => 'An Unstoppable Force Meets an Immovable Object',
                    'white_player' => 'Mikhail Botvinnik',
                    'black_player' => 'Mikhail Tal',
                    'white_title' => 'GM',
                    'black_title' => 'GM',
                    'when' => 'Botvinnik - Tal World Championship Match, 1960.03.26 Round 6',
                    'where' => 'Moscow, USSR',
                ],

                [
                    'theme' => 1,
                    'orientation' => 0,
                    'starting_position' => 'rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR w KQkq - 0 1',
                    'pgn' => '1. Nf3 Nf6 2. c4 g6 3. Nc3 Bg7 4. d4 O-O 5. Bf4 d5 6. Qb3 dxc4 7. Qxc4 c6 8. e4 Nbd7 9. Rd1 Nb6 10. Qc5 Bg4 11. Bg5 Na4 12. Qa3 Nxc3 13. bxc3 Nxe4 14. Bxe7 Qb6 15. Bc4 Nxc3 16. Bc5 Rfe8+ 17. Kf1 Be6 18. Bxb6 Bxc4+ 19. Kg1 Ne2+ 20. Kf1 Nxd4+ 21. Kg1 Ne2+ 22. Kf1 Nc3+ 23. Kg1 axb6 24. Qb4 Ra4 25. Qxb6 Nxd1 26. h3 Rxa2 27. Kh2 Nxf2 28. Re1 Rxe1 29. Qd8+ Bf8 30. Nxe1 Bd5 31. Nf3 Ne4 32. Qb8 b5 33. h4 h5 34. Ne5 Kg7 35. Kg1 Bc5+ 36. Kf1 Ng3+ 37. Ke1 Bb4+ 38. Kd1 Bb3+ 39. Kc1 Ne2+ 40. Kb1 Nc3+ 41. Kc1 Rc2#',
                    'diagram_position' => 34,
                    'move_comment' => 'Leaving the Queen En Prise',
                    'fen' => 'r3r1k1/pp3pbp/1qp1b1p1/2B5/2BP4/Q1n2N2/P4PPP/3R1K1R w - - 4 18',
                    'result' => '0-1',
                    'title' => 'Game Of The Century',
                    'white_player' => 'Donald Byrne',
                    'black_player' => 'Robert James Fischer',
                    'white_title' => 'IM',
                    'when' => 'Third Rosenwald Trophy, 1956.10.17 Round 8',
                    'where' => 'New York, NY USA',
                ],

                [
                    'theme' => 1,
                    'orientation' => 1,
                    'starting_position' => 'rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR w KQkq - 0 1',
                    'pgn' => '1. d4 d5 2. c4 c6 3. Nc3 Nf6 4. Nf3 e6 5. Bg5 dxc4 6. e4 b5 7. a4 Bb7 8. axb5 cxb5 9. Nxb5 Qb6 10. Qa4 Nc6 11. Bxf6 gxf6 12. Bxc4 a6 13. Nc3 Qxb2 14. O-O Qxc3 15. d5 Qb4 16. dxc6 Bc8 17. Qa2 Bh6 18. Qe2 a5 19. Rfb1 Qc3 20. Ra4 O-O 21. h3 Bf4 22. g3 Rb8 23. Rxb8 Bxb8 24. Qd3 Qc1+ 25. Kg2 Bc7 26. Qd2 Qxd2 27. Nxd2 e5 28. Nb3 Be6 29. Nc5 Bxc4 30. Rxc4 Ra8 31. Kf3 Kf8 32. Kg4 Ke7 33. Kf5 Bb6 34. Nd7 Bxf2 35. Nxf6 Bxg3 36. Nd5+ Kd6 37. Nb6 Rg8 38. c7 Bh4 39. c8=N+',
                    'diagram_position' => 77,
                    'move_comment' => 'Underpromotion leads to immediate resignation',
                    'fen' => '2N3r1/5p1p/1N1k4/p3pK2/2R1P2b/7P/8/8 b - - 0 39',
                    'result' => '1-0',
                    'title' => 'Finishing in style',
                    'white_player' => 'Pia Cramling',
                    'black_player' => 'Alisa Mikhailovna Galliamova',
                    'white_rating' => 2515,
                    'black_rating' => 2412,
                    'white_title' => 'GM',
                    'black_title' => 'IM',
                    'when' => 'Candidates (Women), 1994.09.29 Round 17',
                    'where' => 'Tilburg, Netherlands',
                ],

                [
                    'theme' => 1,
                    'orientation' => 0,
                    'starting_position' => 'rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR w KQkq - 0 1',
                    'pgn' => '1. e4 d5 2. exd5 Nf6 3. d4 Nxd5 4. Nf3 Bg4 5. Be2 Nc6 6. O-O e6 7. c4 Nb6 8. Be3 Bxf3 9. Bxf3 Nxc4 10. Qb3 Nb6 11. d5 exd5 12. Bxb6 axb6 13. Bxd5 Qf6 14. Nc3 Be7 15. Ne4 Qg6 16. f4 O-O-O 17. f5 Qg4 18. Bxc6 bxc6 19. Qa4 Kb8 20. Qxc6 Bd6 21. Rac1 Be5 22. Rf3 Rhe8 23. Nf2 Qh5 24. Rh3 Qg5 25. Ra3 Qxc1+ 26. Qxc1 Bxb2 27. Ra8+ Kxa8 28. Qc6+ Kb8 29. Ne4 Bd4+ 30. Kh1 Re5 31. g4 Rde8 32. Ng3 Bc5 33. a4 Bd6 34. Qd7 R8e7 35. Qc6 Rc5 36. Qf3 Rc4 37. Kg2 Rxa4 38. Nh5 Ra2+ 39. Kf1 Bb4',
                    'diagram_position' => 50,
                    'move_comment' => 'The end of the beginning',
                    'fen' => '1k1rr3/2p2ppp/1pQ5/4bP2/8/R7/PP3NPP/2q3K1 w - - 0 26',
                    'result' => '0-1',
                    'title' => 'Queen Sacrifice',
                    'white_player' => 'Aleksander Sznapik',
                    'black_player' => 'Nona Gaprindashvili',
                    'white_title' => 'IM',
                    'black_title' => 'GM',
                    'when' => 'Sandomierz Vitrobud op, 1976.09.06 Round 8',
                    'where' => 'Sandomierz, Poland',
                ],

                [
                    'theme' => 1,
                    'orientation' => 1,
                    'starting_position' => 'rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR w KQkq - 0 1',
                    'pgn' => '1. e4 Nf6 2. e5 Nd5 3. d4 d6 4. Nf3 g6 5. Bc4 Nb6 6. Bb3 Bg7 7. Qe2 Nc6 8. O-O O-O 9. h3 a5 10. a4 dxe5 11. dxe5 Nd4 12. Nxd4 Qxd4 13. Re1 e6 14. Nd2 Nd5 15. Nf3 Qc5 16. Qe4 Qb4 17. Bc4 Nb6 18. b3 Nxc4 19. bxc4 Re8 20. Rd1 Qc5 21. Qh4 b6 22. Be3 Qc6 23. Bh6 Bh8 24. Rd8 Bb7 25. Rad1 Bg7 26. R8d7 Rf8 27. Bxg7 Kxg7 28. R1d4 Rae8 29. Qf6+ Kg8 30. h4 h5 31. Kh2 Rc8 32. Kg3 Rce8 33. Kf4 Bc8 34. Kg5',
                    'diagram_position' => 67,
                    'move_comment' => 'One of the most peculiar mating net setups',
                    'fen' => '2b1rrk1/2pR1p2/1pq1pQp1/p3P1Kp/P1PR3P/5N2/2P2PP1/8 b - - 7 34',
                    'result' => '1-0',
                    'title' => 'The Immortal King Walk',
                    'white_player' => 'Nigel Short',
                    'black_player' => 'Jan Timman',
                    'white_rating' => 2635,
                    'black_rating' => 2630,
                    'white_title' => 'GM',
                    'black_title' => 'GM',
                    'when' => 'Interpolis 15th, 1991.10.21 Round 4',
                    'where' => 'Tilburg, Netherlands',
                ],

                [
                    'theme' => 1,
                    'orientation' => 0,
                    'starting_position' => 'rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR w KQkq - 0 1',
                    'pgn' => '1. d4 Nf6 2. c4 g6 3. Nc3 Bg7 4. e4 d6 5. Nf3 O-O 6. Be2 e5 7. O-O Nc6 8. d5 Ne7 9. Nd2 Ne8 10. b4 f5 11. c5 Nf6 12. f3 f4 13. Nc4 g5 14. a4 Ng6 15. Ba3 Rf7 16. b5 dxc5 17. Bxc5 h5 18. a5 g4 19. b6 g3 20. Kh1 Bf8 21. d6 axb6 22. Bg1 Nh4 23. Re1 Nxg2 24. dxc7 Nxe1 25. Qxe1 g2+ 26. Kxg2 Rg7+ 27. Kh1 Bh3 28. Bf1 Qd3 29. Nxe5 Bxf1 30. Qxf1 Qxc3 31. Rc1 Qxe5 32. c8=Q Rxc8 33. Rxc8 Qe6',
                    'diagram_position' => 48,
                    'move_comment' => 'The first of many attempts by Nakamura to give away his most precious piece',
                    'fen' => 'r1bq1bk1/1pP2r2/1p3n2/P3p2p/2N1Pp2/2N2Pp1/4B2P/R2Qn1BK w - - 0 25',
                    'result' => '0-1',
                    'title' => "I'm Afraid I Must Insist",
                    'white_player' => 'Boris Gelfand',
                    'black_player' => 'Hikaru Nakamura',
                    'white_rating' => 2761,
                    'black_rating' => 2708,
                    'white_title' => 'GM',
                    'black_title' => 'GM',
                    'when' => 'World Team Championship, 2010.01.09 Round 5',
                    'where' => 'Bursa, Turkey',
                ],

            )
            ->create();
    }
}
