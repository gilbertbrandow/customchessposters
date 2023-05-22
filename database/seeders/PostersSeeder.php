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

        $posters = [
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
                'theme' => 0,
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
                'theme' => 0,
                'orientation' => 1,
                'starting_position' => 'rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR w KQkq - 0 1',
                'pgn' => '1. d4 Nf6 2. Nf3 d5 3. Bf4 c5 4. e3 Nc6 5. Nbd2 cxd4 6. exd4 Bf5 7. c3 e6 8. Bb5 Bd6 9. Bxd6 Qxd6 10. O-O O-O 11. Re1 h6 12. Ne5 Ne7 13. a4 a6 14. Bf1 Nd7 15. Nxd7 Qxd7 16. a5 Qc7 17. Qf3 Rfc8 18. Ra3 Bg6 19. Nb3 Nc6 20. Qg3 Qe7 21. h4 Re8 22. Nc5 e5 23. Rb3 Nxa5 24. Rxe5 Qf6 25. Ra3 Nc4 26. Bxc4 dxc4 27. h5 Bc2 28. Nxb7 Qb6 29. Nd6 Rxe5 30. Qxe5 Qxb2 31. Ra5 Kh7 32. Rc5 Qc1+ 33. Kh2 f6 34. Qg3 a5 35. Nxc4 a4 36. Ne3 Bb1 37. Rc7 Rg8 38. Nd5 Kh8 39. Ra7 a3 40. Ne7 Rf8 41. d5 a2 42. Qc7 Kh7 43. Ng6 Rg8 44. Qf7',
                'diagram_position' => 81,
                'move_comment' => 'Unassuming, but devastating',
                'fen' => '5r1k/R3N1p1/5p1p/3P3P/8/p1P3Q1/5PPK/1bq5 b - - 0 41',
                'result' => '1-0',
                'title' => 'Weaving a Mating Net',
                'white_player' => 'Liren, Ding',
                'black_player' => 'Nepomniachtchi, Ian',
                'white_rating' => 2788,
                'black_rating' => 2795,
                'white_title' => 'GM',
                'black_title' => 'GM',
                'when' => 'World Championship 2023, Round 6',
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
                'theme' => 0,
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
                'theme' => 0,
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

            [
                'theme' => 1,
                'orientation' => 1,
                'starting_position' => 'rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR w KQkq - 0 1',
                'pgn' => '1. e4 e5 2. Nf3 Nc6 3. Bb5 a6 4. Ba4 Nf6 5. O-O Be7 6. Re1 b5 7. Bb3 O-O 8. c3 d5 9. exd5 Nxd5 10. Nxe5 Nxe5 11. Rxe5 Nf6 12. Re1 Bd6 13. h3 Ng4 14. Qf3 Qh4 15. d4 Nxf2 16. Re2 Bg4 17. hxg4 Bh2+ 18. Kf1 Bg3 19. Rxf2 Qh1+ 20. Ke2 Bxf2 21. Bd2 Bh4 22. Qh3 Rae8+ 23. Kd3 Qf1+ 24. Kc2 Bf2 25. Qf3 Qg1 26. Bd5 c5 27. dxc5 Bxc5 28. b4 Bd6 29. a4 a5 30. axb5 axb4 31. Ra6 bxc3 32. Nxc3 Bb4 33. b6 Bxc3 34. Bxc3 h6 35. b7 Re3 36. Bxf7+',
                'diagram_position' => 15,
                'move_comment' => 'Then it was a novelty, now it is the Marshall Attack',
                'fen' => 'r1bq1rk1/2ppbppp/p1n2n2/1p2p3/4P3/1BP2N2/PP1P1PPP/RNBQR1K1 b - - 0 8',
                'result' => '1-0',
                'title' => 'A Deadly Weapon Saved for eight years',
                'white_player' => 'Jose Raul Capablanca',
                'black_player' => 'Frank James Marshall',
                'white_title' => 'GM',
                'black_title' => 'GM',
                'when' => '1918.10.23, Round 1',
                'where' => 'New York, NY USA',
            ],

            [
                'theme' => 1,
                'orientation' => 1,
                'starting_position' => 'rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR w KQkq - 0 1',
                'pgn' => '1. Nf3 Nf6 2. c4 e6 3. g3 d5 4. Bg2 Be7 5. d4 O-O 6. Qc2 c5 7. O-O cxd4 8. Nxd4 e5 9. Nf5 d4 10. Nxe7+ Qxe7 11. Bg5 h6 12. Bxf6 Qxf6 13. Nd2 Bf5 14. Qb3 Nd7 15. Qa3 Qb6 16. Rfc1 Rfc8 17. b4 a5 18. c5 Qa6 19. Nc4 Be6 20. Nd6 axb4 21. Qxa6 bxa6 22. Nxc8 Rxc8 23. c6 Nb6 24. Rab1 a5 25. a3 b3 26. c7 Bc4 27. Bb7 Rxc7 28. Rxb3 Rxb7 29. Rxc4 Nxc4 30. Rxb7 Nxa3 31. Kg2 Nc4 32. g4 Nd6 33. Ra7 f6 34. Rxa5 Ne4 35. h4 h5 36. gxh5 Kh7 37. Ra8 Nd6 38. Kf3 Nf5 39. Kg4 Nh6+ 40. Kh3 Nf5 41. Rd8 Nh6 42. f4 exf4 43. Rxd4 Nf7 44. Rxf4 Kh6 45. Rf5 Nd6 46. Rd5 Nc4 47. Kg3 Ne3 48. Rc5 Nf1+ 49. Kf4 Nd2 50. e3 Nb3 51. Rc3 Na5 52. Rc8 Kh7 53. Kf5',
                'diagram_position' => 39,
                'move_comment' => 'An Octopus Knight',
                'fen' => 'r1r3k1/1p1n1pp1/q2Nb2p/p1P1p3/1P1p4/Q5P1/P3PPBP/R1R3K1 b - - 4 20',
                'result' => '1-0',
                'title' => 'Kingslayer',
                'white_player' => 'Aronian, Levon',
                'black_player' => 'Carlsen, Magnus',
                'white_rating' => 2826,
                'black_rating' => 2872,
                'white_title' => 'GM',
                'black_title' => 'GM',
                'when' => 'Zurich CC Rapid 2014, 2014.02.04 Round 2.3',
                'where' => 'Zurich, Switzerland',
            ],

            [
                'theme' => 0,
                'orientation' => 1,
                'starting_position' => 'rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR w KQkq - 0 1',
                'pgn' => '1. d4 Nf6 2. Nf3 g6 3. c4 Bg7 4. g3 O-O 5. Bg2 c6 6. Nc3 d6 7. O-O Qa5 8. h3 Qa6 9. Nd2 Nbd7 10. b3 Rb8 11. Bb2 b5 12. e4 e5 13. cxb5 cxb5 14. a4 bxa4 15. Nc4 Qb7 16. Nxd6 Qxb3 17. Nxa4 exd4 18. Bxd4 Qe6 19. Bxa7 Ra8 20. Nc3 Ne8 21. Nxe8 Rxe8 22. e5 Qxe5 23. Bxa8 Qxc3 24. Qa4 Qe5 25. Rac1 Nf6 26. Bc6 Rf8 27. Bc5 Bxh3 28. Bxf8 Bxf8 29. Rfe1 Qg5 30. Bg2 Be6 31. Rb1 Bc5 32. Rxe6 fxe6 33. Rb7 Qc1+ 34. Kh2 Bf8 35. Bh3 Qd2 36. Bxe6+ Kh8 37. Kg2 Qd6 38. Qc4 h5 39. Qc8',
                'diagram_position' => 43,
                'move_comment' => 'Unleashing the second Bishop',
                'fen' => 'r1b1r1k1/B2n1pbp/4q1p1/4P3/8/2N3PP/5PB1/R2Q1RK1 b - - 0 22',
                'result' => '1-0',
                'title' => 'Clearing the Gun Range',
                'white_player' => 'Koneru, Humpy',
                'black_player' => 'Miroshnichenko, Evgenij',
                'white_rating' => 2572,
                'black_rating' => 2671,
                'white_title' => 'GM',
                'black_title' => 'GM',
                'when' => 'Abu Dhabi op 17th, 2007.08.20 Round 9',
                'where' => 'Abu Dhabi',

            ],

            [
                'theme' => 1,
                'orientation' => 1,
                'starting_position' => 'rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR w KQkq - 0 1',
                'pgn' => '1. e4 d6 2. d4 Nf6 3. Nc3 g6 4. Be3 Bg7 5. Qd2 c6 6. f3 b5 7. Nge2 Nbd7 8. Bh6 Bxh6 9. Qxh6 Bb7 10. a3 e5 11. O-O-O Qe7 12. Kb1 a6 13. Nc1 O-O-O 14. Nb3 exd4 15. Rxd4 c5 16. Rd1 Nb6 17. g3 Kb8 18. Na5 Ba8 19. Bh3 d5 20. Qf4+ Ka7 21. Rhe1 d4 22. Nd5 Nbxd5 23. exd5 Qd6 24. Rxd4 cxd4 25. Re7+ Kb6 26. Qxd4+ Kxa5 27. b4+ Ka4 28. Qc3 Qxd5 29. Ra7 Bb7 30. Rxb7 Qc4 31. Qxf6 Kxa3 32. Qxa6+ Kxb4 33. c3+ Kxc3 34. Qa1+ Kd2 35. Qb2+ Kd1 36. Bf1 Rd2 37. Rd7 Rxd7 38. Bxc4 bxc4 39. Qxh8 Rd3 40. Qa8 c3 41. Qa4+ Ke1 42. f4 f5 43. Kc1 Rd2 44. Qa7',
                'diagram_position' => 47,
                'move_comment' => 'Out of nowhere',
                'fen' => 'b2r3r/k4p1p/p2q1np1/NppP4/3R1Q2/P4PPB/1PP4P/1K2R3 b - - 0 24',
                'result' => '1-0',
                'title' => "Kasparov's Immortal Game",
                'white_player' => 'Garry Kasparov',
                'black_player' => 'Veselin Topalov',
                'white_rating' => 2812,
                'black_rating' => 2700,
                'white_title' => 'GM',
                'black_title' => 'GM',
                'when' => 'Hoogovens Group A, 1999.01.20 Round 4',
                'where' => 'Wijk aan Zee, Netherlands',
            ],

            [
                'theme' => 1,
                'orientation' => 1,
                'starting_position' => 'rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR w KQkq - 0 1',
                'pgn' => '1. e4 c5 2. Nf3 d6 3. Bb5+ Nd7 4. d4 Nf6 5. O-O cxd4 6. Qxd4 a6 7. Bxd7+ Bxd7 8. Bg5 h6 9. Bxf6 gxf6 10. c4 e6 11. Nc3 Rc8 12. Kh1 h5 13. a4 h4 14. h3 Be7 15. b4 a5 16. b5 Qc7 17. Nd2 Qc5 18. Qd3 Rg8 19. Rae1 Qg5 20. Rg1 Qf4 21. Ref1 b6 22. Ne2 Qh6 23. c5 Rxc5 24. Nc4 Kf8 25. Nxb6 Be8 26. f4 f5 27. exf5 Rxf5 28. Rc1 Kg7 29. g4 Rc5 30. Rxc5 dxc5 31. Nc8 Bf8 32. Qd8 Qg6 33. f5 Qh6 34. g5 Qh5 35. Rg4 exf5 36. Nf4 Qh8 37. Qf6+ Kh7 38. Rxh4+',
                'diagram_position' => 45,
                'move_comment' => 'Clearing an outpost square for the Knight',
                'fen' => '2r1k1r1/3bbp2/1p1ppp1q/pPP5/P3P2p/3Q3P/3NNPP1/5RRK b - - 0 23',
                'result' => '1-0',
                'title' => 'Bishop Pair Advantage? Never heard of it.',
                'white_player' => 'Vassily Ivanchuk',
                'black_player' => 'Garry Kasparov',
                'white_rating' => 2735,
                'black_rating' => 2800,
                'white_title' => 'GM',
                'black_title' => 'GM',
                'when' => 'Linares, 1991.02.23 Round 1',
                'where' => 'Linares, Spain',
            ],

            [
                'theme' => 0,
                'orientation' => 1,
                'starting_position' => 'rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR w KQkq - 0 1',
                'pgn' => '1. e4 c5 2. Nf3 d6 3. d4 cxd4 4. Nxd4 Nf6 5. Nc3 a6 6. Be3 e6 7. g4 e5 8. Nf5 g6 9. g5 gxf5 10. exf5 d5 11. Qf3 d4 12. O-O-O Nbd7 13. Bd2 dxc3 14. Bxc3 Bg7 15. Rg1 O-O 16. gxf6 Qxf6 17. Qe3 Kh8 18. f4 Qb6 19. Qg3 Qh6 20. Rd6 f6 21. Bd2 e4 22. Bc4 b5 23. Be6 Ra7 24. Rc6 a5 25. Be3 Rb7 26. Bd5 Rb8 27. Rc7 b4 28. b3 Rb5 29. Bc6 Rxf5 30. Rxc8 Rxc8 31. Bxd7 Rcc5 32. Bxf5 Rxf5 33. Rd1 Kg8 34. Qg2',
                'diagram_position' => 27,
                'move_comment' => 'Quality of Pieces > Quantity',
                'fen' => 'r1bqkb1r/1p1n1p1p/p4n2/4pPP1/8/2B2Q2/PPP2P1P/2KR1B1R b kq - 0 14',
                'result' => '1-0',
                'title' => 'King Safety Is The no. 1 Priority',
                'white_player' => 'Judit Polgar',
                'black_player' => 'Viswanathan Anand',
                'white_rating' => 2677,
                'black_rating' => 2781,
                'white_title' => 'GM',
                'black_title' => 'GM',
                'when' => 'Dos Hermanas, 1999.04.06 Round 1',
                'where' => 'Dos Hermanas, Spain',
            ],

            [
                'theme' => 1,
                'orientation' => 0,
                'starting_position' => 'rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR w KQkq - 0 1',
                'pgn' => '1. d4 f5 2. c4 Nf6 3. Nc3 e6 4. Nf3 d5 5. e3 c6 6. Bd3 Bd6 7. O-O O-O 8. Ne2 Nbd7 9. Ng5 Bxh2+ 10. Kh1 Ng4 11. f4 Qe8 12. g3 Qh5 13. Kg2 Bg1 14. Nxg1 Qh2+ 15. Kf3 e5 16. dxe5 Ndxe5+ 17. fxe5 Nxe5+ 18. Kf4 Ng6+ 19. Kf3 f4 20. exf4 Bg4+ 21. Kxg4 Ne5+ 22. fxe5 h5#',
                'diagram_position' => 42,
                'move_comment' => 'The fourth sacrifice of a minor piece',
                'fen' => 'r4rk1/pp4pp/2p5/3pn1N1/2P2PK1/3B2P1/PP5q/R1BQ1RN1 w - - 1 22',
                'result' => '0-1',
                'title' => 'In For a Penny, In For a Dime',
                'white_player' => 'Glucksberg',
                'black_player' => 'Miguel Najdorf',
                'black_title' => 'GM',
                'when' => '1929',
                'where' => 'Warsaw Poland',
            ],

            [
                'theme' => 1,
                'orientation' => 1,
                'starting_position' => 'rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR w KQkq - 0 1',
                'pgn' => '1. e4 e5 2. Nf3 Nc6 3. Bc4 Bc5 4. b4 Bxb4 5. c3 Ba5 6. d4 exd4 7. O-O d3 8. Qb3 Qf6 9. e5 Qg6 10. Re1 Nge7 11. Ba3 b5 12. Qxb5 Rb8 13. Qa4 Bb6 14. Nbd2 Bb7 15. Ne4 Qf5 16. Bxd3 Qh5 17. Nf6+ gxf6 18. exf6 Rg8 19. Rad1 Qxf3 20. Rxe7+ Nxe7 21. Qxd7+ Kxd7 22. Bf5+ Ke8 23. Bd7+ Kf8 24. Bxe7#',
                'diagram_position' => 41,
                'move_comment' => 'Springing the trap',
                'fen' => '1r2k1r1/pbpQnp1p/1b3P2/8/8/B1PB1q2/P4PPP/3R2K1 b - - 0 21',
                'result' => '1-0',
                'title' => 'The Evergreen Game',
                'white_player' => 'Adolf Anderssen',
                'black_player' => 'Jean Dufresne',
                'when' => '1852',
                'where' => 'Berlin, Germany',
            ],


            [
                'theme' => 0,
                'orientation' => 1,
                'starting_position' => 'rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR w KQkq - 0 1',
                'pgn' => '1. e4 c6 2. d4 d5 3. e5 Bf5 4. Nf3 e6 5. Be2 Nd7 6. O-O Bg6 7. Nbd2 Nh6 8. Nb3 Nf5 9. Bd2 Be7 10. g4 Nh4 11. Nxh4 Bxh4 12. f4 f5 13. c4 a5 14. a4 O-O 15. g5 h6 16. gxh6 gxh6 17. Kh1 Kh7 18. cxd5 cxd5 19. Rc1 b6 20. Rc6 Rc8 21. Rxe6 Bf7 22. Rd6 Be7 23. Bd3 Bxd6 24. Bxf5+ Kh8 25. Qg4 Rc7 26. Qh3 h5 27. exd6 Ra7 28. Be6 Nf6 29. f5 Qxd6 30. Bf4 Qd8 31. Be5 Bg8 32. Qxh5+ Rh7 33. Qg5 Qe7 34. Nc1 Qg7 35. Qxg7+ Rxg7 36. Nd3 Rg4 37. Nf4 Kh7 38. h3 Rg3 39. Ng6 Rxh3+ 40. Kg2',
                'diagram_position' => 67,
                'move_comment' => 'The beginning of a long journey',
                'fen' => '5rbk/4q2r/1p2Bn2/p2pBPQ1/P2P4/8/1P5P/2N2R1K b - - 4 34',
                'result' => '1-0',
                'title' => 'Hardest Move to Find Is With The Knight Backwards',
                'white_player' => 'Yifan Hou',
                'black_player' => 'David Navara',
                'white_rating' => 2673,
                'black_rating' => 2730,
                'white_title' => 'GM',
                'black_title' => 'GM',
                'when' => "Tata Steel Masters, Round 4",
                'where' => 'Wijk aan Zee, Netherlands',
            ],

            [
                'theme' => 0,
                'orientation' => 1,
                'starting_position' => 'rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR w KQkq - 0 1',
                'pgn' => '1. c4 e6 2. Nc3 d5 3. d4 Nf6 4. Nf3 Be7 5. Bf4 O-O 6. e3 b6 7. Qc2 Ba6 8. O-O-O dxc4 9. Ng5 Nc6 10. a3 g6 11. h4 Bd6 12. g3 Qe7 13. h5 e5 14. hxg6 hxg6 15. Bg2 exf4 16. Bxc6 fxg3 17. Kb1 Rad8 18. f4 Bc8 19. Rde1 Kg7 20. Nd5 Nxd5 21. Rh7+ Kg8 22. Rxf7 Rxf7 23. Qxg6+ Kf8 24. Qh6+ Rg7 25. Bxd5 Ke8 26. Qh5+ Kd7 27. Qh3+ Ke8 28. Qh5+ Kd7 29. Be6+ Kc6 30. Qf3+ Kb5 31. Bxc4+ Ka5 32. Qd5+ Bc5 33. b4+ Ka4 34. Qg2 Bxb4 35. Qc6+ Kxa3 36. Bb3 Bd7 37. Qc1+ Kxb3 38. Qc2+ Ka3 39. Qa2#',
                'diagram_position' => 58,
                'move_comment' => 'Fortune favors the bold. Sometimes.',
                'fen' => '2br4/p1p1q1r1/1pkbB3/6NQ/2pP1P2/P3P1p1/1P6/1K2R3 w - - 9 30',
                'result' => '1-0',
                'title' => 'Mate in 13',
                'white_player' => 'Daniil Dubov',
                'black_player' => 'Rasmus Svane',
                'white_rating' => 2699,
                'black_rating' => 2592,
                'white_title' => 'GM',
                'black_title' => 'GM',
                'when' => 'European Team Championship (2019)',
                'where' => 'Batumi, Georgia',
            ],

            [
                'theme' => 0,
                'orientation' => 1,
                'starting_position' => 'rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR w KQkq - 0 1',
                'pgn' => '1. e4 c5 2. Nf3 d6 3. d4 cxd4 4. Nxd4 Nf6 5. f3 e5 6. Nb3 Be7 7. c4 a5 8. Be3 a4 9. Nc1 O-O 10. Nc3 Qa5 11. Qd2 Na6 12. Be2 Nc5 13. O-O Bd7 14. Rb1 Rfc8 15. b4 axb3 16. axb3 Qd8 17. Nd3 Ne6 18. Nb4 Bc6 19. Rfd1 h5 20. Bf1 h4 21. Qf2 Nd7 22. g3 Ra3 23. Bh3 Rca8 24. Nc2 R3a6 25. Nb4 Ra5 26. Nc2 b6 27. Rd2 Qc7 28. Rbd1 Bf8 29. gxh4 Nf4 30. Bxf4 exf4 31. Bxd7 Qxd7 32. Nb4 Ra3 33. Nxc6 Qxc6 34. Nb5 Rxb3 35. Nd4 Qxc4 36. Nxb3 Qxb3 37. Qe2 Be7 38. Kg2 Qe6 39. h5 Ra3 40. Rd3 Ra2 41. R3d2 Ra3 42. Rd3 Ra7 43. Rd5 Rc7 44. Qd2 Qf6 45. Rf5 Qh4 46. Rc1 Ra7 47. Qxf4 Ra2+ 48. Kh1 Qf2 49. Rc8+ Kh7 50. Qh6+',
                'diagram_position' => 99,
                'move_comment' => 'A beautiful move to conclude the WCC',
                'fen' => '2R5/4bppk/1p1p3Q/5R1P/4P3/5P2/r4q1P/7K b - - 6 50',
                'result' => '1-0',
                'title' => 'Queen Sacrifice To Retain The Title',
                'white_player' => 'Magnus Carlsen',
                'black_player' => 'Sergey Karjakin',
                'white_rating' => 2840,
                'black_rating' => 2785,
                'white_title' => 'GM',
                'black_title' => 'GM',
                'when' => 'World Championship Match, 2016.11.30 Round 13.4',
                'where' => 'New York, NY USA',
            ],

            [
                'theme' => 1,
                'orientation' => 1,
                'starting_position' => 'rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR w KQkq - 0 1',
                'pgn' => '1. e4 e5 2. Nf3 d6 3. d4 Bg4 4. dxe5 Bxf3 5. Qxf3 dxe5 6. Bc4 Nf6 7. Qb3 Qe7 8. Nc3 c6 9. Bg5 b5 10. Nxb5 cxb5 11. Bxb5+ Nbd7 12. O-O-O Rd8 13. Rxd7 Rxd7 14. Rd1 Qe6 15. Bxd7+ Nxd7 16. Qb8+ Nxb8 17. Rd8#',
                'diagram_position' => 31,
                'move_comment' => 'Continuing the relentless assault',
                'fen' => '1Q2kb1r/p2n1ppp/4q3/4p1B1/4P3/8/PPP2PPP/2KR4 b k - 1 16',
                'result' => '1-0',
                'title' => 'Opera Game',
                'white_player' => 'Paul Morphy',
                'black_player' => 'Duke Karl / Count Isouard',
                'when' => 'Paris, 1858',
                'where' => 'Paris, France',
            ],

            [
                'theme' => 0,
                'orientation' => 1,
                'starting_position' => 'rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR w KQkq - 0 1',
                'pgn' => '1. d4 d5 2. c4 c6 3. Nf3 Nf6 4. Nc3 e6 5. e3 Nbd7 6. Bd3 dxc4 7. Bxc4 b5 8. Bd3 Bd6 9. O-O O-O 10. Qc2 Bb7 11. a3 Rc8 12. Ng5 c5 13. Nxh7 Ng4 14. f4 cxd4 15. exd4 Bc5 16. Be2 Nde5 17. Bxg4 Bxd4+ 18. Kh1 Nxg4 19. Nxf8 f5 20. Ng6 Qf6 21. h3 Qxg6 22. Qe2 Qh5 23. Qd3 Be3',
                'diagram_position' => 32,
                'move_comment' => 'A devastating counterblow',
                'fen' => '2rq1rk1/pb3ppN/4p3/1pb1n3/3P1Pn1/P1N5/1PQ1B1PP/R1B2RK1 w - - 3 17',
                'result' => '0-1',
                'title' => "Nerve's of Steel",
                'white_player' => 'Levon Aronian',
                'black_player' => 'Viswanathan Anand',
                'white_rating' => 2802,
                'black_rating' => 2772,
                'white_title' => 'GM',
                'black_title' => 'GM',
                'when' => 'Tata Steel Group A, 2013.01.15 Round 4',
                'where' => 'Wijk aan Zee NED',
            ],

            [
                'theme' => 1,
                'orientation' => 1,
                'starting_position' => 'rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR w KQkq - 0 1',
                'pgn' => '1. b3 e5 2. Bb2 Nc6 3. c4 Nf6 4. Nf3 e4 5. Nd4 Bc5 6. Nxc6 dxc6 7. e3 Bf5 8. Qc2 Qe7 9. Be2 O-O-O 10. f4 Ng4 11. g3 h5 12. h3 h4 13. hxg4 hxg3 14. Rg1 Rh1 15. Rxh1 g2 16. Rf1 Qh4+ 17. Kd1 gxf1=Q+',
                'diagram_position' => 24,
                'move_comment' => 'The threat of a passed pawn',
                'fen' => '2kr3r/ppp1qpp1/2p5/2b2b2/2P1pPnp/1P2P1PP/PBQPB3/RN2K2R w KQ - 0 13',
                'result' => '0-1',
                'title' => 'When Pawns Attack',
                'white_player' => 'Bent Larsen',
                'black_player' => 'Boris Spassky',
                'white_rating' => 2600,
                'black_rating' => 2650,
                'white_title' => 'GM',
                'black_title' => 'GM',
                'when' => 'USSR vs. Rest of the World, 1970.03.31 Round 2.1',
                'where' => 'Belgrade SRB',
            ],

            [
                'theme' => 1,
                'orientation' => 1,
                'starting_position' => 'rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR w KQkq - 0 1',
                'pgn' => '1. e4 e6 2. d3 d5 3. Nd2 Nf6 4. g3 Be7 5. Bg2 O-O 6. Ngf3 c6 7. O-O b5 8. Re1 Bb7 9. e5 Nfd7 10. Nf1 Re8 11. h4 Nf8 12. N1h2 c5 13. Ng4 Nc6 14. h5 Rc8 15. h6 g6 16. a4 b4 17. Be3 Nd7 18. Qc1 Ba6 19. Qd2 Na5 20. Bg5 c4 21. Bxe7 Qxe7 22. Nd4 Rb8 23. dxc4 Nxc4 24. Qf4 Bb7 25. b3 Na5 26. Bf1 a6 27. Bd3 Rec8 28. Re3 Nc6 29. Nf3 Rc7 30. Ng5 Rbc8 31. Rae1 Nd8 32. R3e2 Rc3 33. Kh2 R8c7 34. Kg1 Bc8 35. Rd2 R3c6 36. Nf3 Rb6 37. Qe3 Rb8 38. Bf1 Rc3 39. Bd3 Nc6 40. Qf4 Bb7 41. Ng5 Bc8 42. Bf1 Ra8 43. Rxd5 exd5 44. e6 fxe6 45. Rxe6 Qf8 46. Qxf8+ Kxf8 47. Nxh7+ Kg8 48. Ng5 Bb7 49. Rxg6+ Kf8 50. h7',
                'diagram_position' => 85,
                'move_comment' => 'Opening the floodgates',
                'fen' => 'r1b3k1/3nqp1p/p1n1p1pP/3RP1N1/Pp3QN1/1Pr3P1/2P2P2/4RBK1 b - - 0 43',
                'result' => '1-0',
                'title' => 'Simply Clearing The Path',
                'white_player' => 'Oscar Panno',
                'black_player' => 'Erich Eliskases',
                'white_rating' => 2540,
                'black_rating' => 2520,
                'white_title' => 'GM',
                'black_title' => 'GM',
                'when' => 'Mar del Plata, 1957.04.06 Round 16',
                'where' => 'Mar del Plata, Argentina',
            ],

        ];

        foreach ($posters as $poster) {
            Poster::create($poster);
        }
    }
}
