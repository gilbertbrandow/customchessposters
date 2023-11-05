<?php

namespace Database\Seeders;

use App\Models\Game;
use Illuminate\Database\Seeder;

class GamesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $games = [

            [
                'poster_id' => 1,
                'name' => 'Fischer - Spassky, World Championship 1972, Game 6',
                'description' => 'Shockingly, Fischer opted out of his "1. e4, best by test" in the crucial Game 6 of the perhaps most iconic World Championship match of all time. After a brilliant victory by Fischer, Spassky rose to his feet and applauded his opponent.',
                'date' => '1972-07-23',
                'white_player' => 1,
                'black_player' => 2,
                'world_championship_game' => 1,
                'opening_id' => 3,
            ],

            [
                'poster_id' => 2,
                'name' => 'A masterclass in king hunts from the greatest ever female player',
                'description' => 'Solidifying her reputation as one of the greatest attacking players, Polgar goes for the head against a promising talent.',
                'date' => '2002-10-29',
                'white_player' => 3,
                'black_player' => 4,
                'world_championship_game' => 0,
                'opening_id' => 1,
            ],

            [
                'poster_id' => 3,
                'name' => 'Ding Liren manages to win with his back against the wall',
                'description' => 'The legendary of Game 6 in the WCC has seen grueling long wins, brilliant novelties and mind-blowing creativity. This game did live up to this rich history.',
                'date' => '2023-04-16',
                'white_player' => 5,
                'black_player' => 6,
                'world_championship_game' => 1,
                'opening_id' => 4,
            ],

            [
                'poster_id' => 4,
                'name' => 'Tal wins another famous Game 6 in WCC 1960',
                'description' => 'The principled, scientific and reigning world champion Mikhail Botvinnik faced of against the brash, creative and talented challenger Mikhail Tal in a WCC for the ages.',
                'date' => '1960-03-26',
                'white_player' => 7,
                'black_player' => 8,
                'world_championship_game' => 1,
                'opening_id' => 5,
            ],

            [
                'poster_id' => 5,
                'name' => 'Young Bobby Fischer shows a glimpse of what is to come',
                'description' => 'IM Donald Byrne, one of the top American masters at the time, had the white pieces against the young Fischer, who was still a year or two away from being well-known. But not too young to give us a true show of brilliancy.',
                'date' => '1956-10-17',
                'white_player' => 9,
                'black_player' => 1,
                'world_championship_game' => 0,
                'opening_id' => 6,
            ],

            [
                'poster_id' => 6,
                'name' => 'Pia Cramling gets an important win with a spectacular finish',
                'description' => 'The most logical way of promotion, promoting a pawn to a Queen, is almost always the best choice. Knowing when it is not takes a great player.',
                'date' => '1994-09-29',
                'white_player' => 10,
                'black_player' => 11,
                'world_championship_game' => 0,
                'opening_id' => 7,
            ],

            [
                'poster_id' => 7,
                'name' => 'Queen Sacrifice by the trailblazer Nona Gaprindashvili',
                'description' => 'With white threatening a seemingly unstoppable mate on a8, Nona (First ever female GM) pulls an ace out of her sleeve. Uncorking an aesthetically pleasing combination to take the initiative!',
                'date' => '1976-09-06',
                'white_player' => 12,
                'black_player' => 13,
                'world_championship_game' => 0,
                'opening_id' => 8,
            ],

            [
                'poster_id' => 8,
                'name' => 'A Short King Walk - Creativity Unleashed',
                'description' => 'In one of the most renowned finishes of any chess game, Nigel Short goes against every chess principle and breaks all the rules. He brings his king to the enemy territory to deliver mate!',
                'date' => '1991-10-21',
                'white_player' => 14,
                'black_player' => 15,
                'world_championship_game' => 0,
                'opening_id' => 9,
            ],

            [
                'poster_id' => 9,
                'name' => 'Nakamura insist on a Botez Gambit',
                'description' => "In creative ways and on five different occasions, Hikaru offers Gelfand his Queen. Even though Boris never obliges, it did become what many believe to be Nakamura's Immortal Game.",
                'date' => '2010-01-05',
                'white_player' => 16,
                'black_player' => 17,
                'world_championship_game' => 0,
                'opening_id' => 10,
            ],

            [
                'poster_id' => 10,
                'name' => 'Uncorking preparation kept for years against a worthy opponent',
                'description' => 'Famously, James Frank Marshall had quietly been studying a new variation in the Ruy Lopez, waiting for the ripe opportunity to spring his trap. A line now widely known and played at the highest level, known simply as the "Marshall Attack".',
                'date' => '1918-10-23',
                'white_player' => 18,
                'black_player' => 19,
                'world_championship_game' => 0,
                'opening_id' => 11,
            ],

            [
                'poster_id' => 11,
                'name' => 'Levon Aronian manages to take down King Magnus',
                'description' => 'Carlsen, a comfortable contender in any Chess GOAT debate and the reigning World Champion is close to an impossible challenge, even for the talented Aronian. Nevertheless, Levon proved even Kings can be toppled.',
                'date' => '2014-02-04',
                'white_player' => 20,
                'black_player' => 21,
                'world_championship_game' => 0,
                'opening_id' => 12,
            ],

            [
                'poster_id' => 12,
                'name' => 'Koneru, World no. 2, Shows The Power of The Sniping Bishops',
                'description' => 'In her game to reach the incredible milestone of 2600 FIDE rating, Humpy faced of against a formidable opponent. By making use of the longest diagonals on the board, she secured the impressive W.',
                'date' => '2007-08-12',
                'white_player' => 22,
                'black_player' => 23,
                'world_championship_game' => 0,
                'opening_id' => 13,
            ],

            [
                'poster_id' => 13,
                'name' => 'Garry displays a superhuman level of calculating',
                'description' => 'Out of nowhere Kasparov plays an eyebrow-raising sacrifice, which after being accepted by Veselin, also spelled doom for the latter.',
                'date' => '1999-01-20',
                'white_player' => 24,
                'black_player' => 25,
                'world_championship_game' => 0,
                'opening_id' => 14,
            ],

            [
                'poster_id' => 14,
                'name' => 'Ivanchuks Immortal Game, proving knights are for more than tricks',
                'description' => 'As a chess player, you are at some point going to learn that retaining both bishops can often lead to an advantage. To some, this advantage is significant and inevitable. Vasyl proves that there are always exceptions to any chess principle.',
                'date' => '1991-02-23',
                'white_player' => 26,
                'black_player' => 24,
                'world_championship_game' => 0,
                'opening_id' => 15,
            ],

            [
                'poster_id' => 15,
                'name' => 'Polgar do to Anand what she does best, attack',
                'description' => 'In a "Novel Novelty" Judit puts on an attacking showcase against current world no 2, future world champion and forever chess legend; Viswanathan Anand.',
                'date' => '1999-04-06',
                'white_player' => 3,
                'black_player' => 27,
                'world_championship_game' => 0,
                'opening_id' => 16,
            ],

            [
                'poster_id' => 16,
                'name' => 'The Polish Immortal Game',
                'description' => 'The Polish-Argentinian Miguel Najdorf, after whom the widely popular Sicilian Najdorf variation is named after, is the author of this masterpiece. A game which is widely known for the fact that all four of blacks minor pieces were sacrificed.',
                'date' => '1929-01-01',
                'white_player' => 28,
                'black_player' => 29,
                'world_championship_game' => 0,
                'opening_id' => 17,
            ],

            [
                'poster_id' => 17,
                'name' => 'A Game Every Chess Player Must Be Familiar With',
                'description' => 'A relic from the past, authored by none other than Adolf Anderssen. From an era in chess when it was considered rude to not accept sacrifices and opening theory was "Control the center and take initiative".',
                'date' => '1852-01-01',
                'white_player' => 30,
                'black_player' => 31,
                'world_championship_game' => 0,
                'opening_id' => 18,
            ],

            [
                'poster_id' => 18,
                'name' => "Yifan's Knight makes a long journey to secure the victory",
                'description' => 'It is sometimes mentioned that the hardest move to find for a chess player is with the knight going backwards. Even in a position where time seem to be of the essence, Hou puts her knight on the first row.',
                'date' => '2016-01-19',
                'white_player' => 32,
                'black_player' => 33,
                'world_championship_game' => 0,
                'opening_id' => 19,
            ],

            [
                'poster_id' => 19,
                'name' => 'Every Brilliancy Is Allowed By A Mistake',
                'description' => 'Daniil Dubov, often hailed as one of the most creative players of his generation, shows us why no masterpiece is created without taking risks.',
                'date' => '2019-01-31',
                'white_player' => 34,
                'black_player' => 35,
                'world_championship_game' => 0,
                'opening_id' => 20,
            ],

            [
                'poster_id' => 20,
                'name' => 'The Greatest Finish To A Championship Match Ever',
                'description' => 'Magnus Carlsen went into the WCC 2016 as a clear favorite over the challenger Sergey Karjakin. After the Russian drew first blood in Magnus came back and evened the score. He then concluded the tiebreaks with this game, retaining his title.',
                'date' => '2016-11-21',
                'white_player' => 21,
                'black_player' => 36,
                'world_championship_game' => 1,
                'opening_id' => 21,
            ],

            [
                'poster_id' => 21,
                'name' => 'The Most Famous Chess Game Ever Played',
                'description' => "Often called the 'Opera Game', Paul Morphy's informal masterpiece played against the Duke of Brunswick and Count Isouard is the first complete game shown to many beginning and intermediate players.",
                'date' => '1892-01-01',
                'white_player' => 37,
                'black_player' => 38,
                'world_championship_game' => 0,
                'opening_id' => 22,
            ],

            [
                'poster_id' => 22,
                'name' => "Anand's Immortal Game",
                'description' => "Played in advance of his coming 2013 world championship match against Magnus Carlsen, Anand showed in this game the attacking skill that makes him such a beloved player; particularly 16...Nde5!!",
                'date' => '2013-01-15',
                'white_player' => 20,
                'black_player' => 27,
                'world_championship_game' => 0,
                'opening_id' => 23,
            ],

            [
                'poster_id' => 23,
                'name' => "Spassky Dismantles The Dane's Unorthodox Opening",
                'description' => 'Bent Larsen, arguably the greatest ever chess player from Denmark, was known for his unusual openings. With which he achieved great success against the strongest in the world. This time however, Boris pick him apart.',
                'date' => '1970-03-31',
                'white_player' => 39,
                'black_player' => 2,
                'world_championship_game' => 0,
                'opening_id' => 24,
            ],

            [
                'poster_id' => 24,
                'name' => 'The Argentinian Legend Puts On A Show',
                'description' => 'Panno was the first top world chess player born in South America. He peaked at 18th in the world in 1955 and appeared again as number 19th overall on the top lists in 1973. In this game he puts his foot on the gas on move 43 and does not ease up.',
                'date' => '1957-04-06',
                'white_player' => 40,
                'black_player' => 41,
                'world_championship_game' => 0,
                'opening_id' => 25,
            ],

            [
                'poster_id' => 25,
                'name' => 'Egyptian GM Warrants Comparison To The Magician From Riga',
                'description' => 'Adham Fawzy (born 2000) was awarded the title Grandmaster by FIDE in 2019. As of May 2023, he is the third-highest rated active Egyptian player, and fourth-highest in the African continent. He garners international fame for this true beauty.',
                'date' => '2022-08-07',
                'white_player' => 42,
                'black_player' => 43,
                'world_championship_game' => 0,
                'opening_id' => 26,
            ],

            [
                'poster_id' => 26,
                'name' => 'Bishop Supremacy In Textbook Endgame',
                'description' => 'Knights are with a lot of pieces still on the board, often able to out-maneuver their bishop counterparts and with the threat of mighty forks or reaching outposts, grant an advantage. However, as the material starts to come off, the long range of the bishop proves to be a great asset.',
                'date' => '2000-12-02',
                'white_player' => 44,
                'black_player' => 45,
                'world_championship_game' => 0,
                'opening_id' => 27,
            ],

            [
                'poster_id' => 27,
                'name' => 'The Brazilian Shuts The Door on King Magnus',
                'description' => 'In an online blitz game, the brazilian makes quick work of the Norwegian. Raising eyebrows with the showstopper Qc6!!',
                'date' => '2020-05-26',
                'white_player' => 46,
                'black_player' => 21,
                'world_championship_game' => 0,
                'opening_id' => 28,
            ],

            [
                'poster_id' => 28,
                'name' => 'Max Euwe proves The Power Of Connected Passed Pawns',
                'description' => 'In thrilling match that saw Alexander Alekhine eventually be dethroned by Euwe, this game 26 played a pivotal role in tipping the scales. Max Euwe put the power of passed pawns on full display, which he gained in exchange for a piece.',
                'date' => '1935-12-03',
                'white_player' => 47,
                'black_player' => 48,
                'world_championship_game' => 1,
                'opening_id' => 29,
            ],

            [
                'poster_id' => 29,
                'name' => 'Firouzja Puts On A Clinic',
                'description' => 'In a explosive chess game, the young up and coming talent puts on a show from start to finish.',
                'date' => '2020-03-22',
                'white_player' => 50,
                'black_player' => 51,
                'world_championship_game' => 0,
                'opening_id' => 31,
            ],

            [
                'poster_id' => 30,
                'name' => 'The First Zambian GM Takes On A Unique Pawn Structure',
                'description' => 'Simutowe is the first GM from sub-saharan Africa. In this game from the British championships Amon finished with 6½/11, but also produced this gem of a game.',
                'date' => '2000-01-01',
                'white_player' => 52,
                'black_player' => 53,
                'world_championship_game' => 0,
                'opening_id' => 32,
            ],

            [
                'poster_id' => 31,
                'name' => 'A Sign Of What Was To Come',
                'description' => 'This was the first game to be won by a chess-playing computer against a reigning world champion under normal chess tournament conditions, and in particular, classical time controls.',
                'date' => '1996-02-10',
                'white_player' => 49,
                'black_player' => 24,
                'world_championship_game' => 0,
                'opening_id' => 30,
            ],

            [
                'poster_id' => 32,
                'name' => 'Ju Traps The Israeli GM in the middle of the board',
                'description' => "In March 2017, Ju Wenjun became the sixth (and most recent) woman to achieve a rating above 2600. She is a three-time Women's World Chess Champion having won the title in May 2018, November 2018 and 2020. She is defending it once more July 2023.",
                'date' => '2017-01-26',
                'white_player' => 54,
                'black_player' => 55,
                'world_championship_game' => 0,
                'opening_id' => 33,
            ],

            [
                'poster_id' => 33,
                'name' => 'A Chessbrah proves knights are tricky even for GMs',
                'description' => 'Eric Hansen (born May 24, 1992) is a Canadian chess grandmaster and Twitch streamer. FIDE awarded him the grandmaster title in 2013.',
                'date' => '2018-03-07',
                'white_player' => 56,
                'black_player' => 57,
                'world_championship_game' => 0,
                'opening_id' => 34,
            ],

            [
                'poster_id' => 34,
                'name' => 'From Madness To Bishop Pair From Hell',
                'description' => 'Eugenio "Eugene" Torre is a Filipino chess player. In 1974, at 22 years old, he became the first Filipino and Asian to qualify for the title Grandmaster. Torre did this by winning the silver medal in the 21st Chess Olympiad in Nice, France. He is considered the strongest chess player the Philippines produced during the 1980s and 1990s,',
                'date' => '1976-10-28',
                'white_player' => 58,
                'black_player' => 59,
                'world_championship_game' => 0,
                'opening_id' => 35,
            ],

            [
                'poster_id' => 35,
                'name' => 'Nijat Goes For Glory In Front Of His Home Crowd',
                'description' => 'NIjat Abasov was seeded 69th coming into the world cup, and ranked 4th in Azerbaijan. Against all odds he eliminated Anish Giri and Peter Svidler. Now he gives it his all to be among the final 16.',
                'date' => '2023-08-12',
                'white_player' => 60,
                'black_player' => 61,
                'world_championship_game' => 0,
                'opening_id' => 4,
            ],

            [
                'poster_id' => 36,
                'name' => 'Morphy-esque Play in a Upset of The Year',
                'description' => 'Alisher Suleymenov puts on a performance reminiscent of old masters agains the number 1. ranked player in the world.',
                'date' => '2023-10-13',
                'white_player' => 62,
                'black_player' => 21,
                'world_championship_game' => 0,
                'opening_id' => 36,
            ],

        ];

        foreach ($games as $game) {

            Game::create($game);

            //In order to be able to sort by created_at and not get confusing results
            sleep(1);
        }
    }
}
