-- Small sample dataset for freespace
USE freespace;

INSERT INTO post (post_title, post_content, post_author, post_tags, post_creation_time, post_likes, post_dislikes) VALUES
('Welcome to freespace!', 'No moderation, no accounts: just pure fun. Say hi!', 'dave', 'welcome,intro', NOW() - INTERVAL 3 DAY, 5, 0),
('What are you building this weekend?', 'Currently messing around with an old PHP project of mine.', 'anon42', 'php,projects', NOW() - INTERVAL 2 DAY, 3, 1),
('Best pizza topping?', 'Wrong answers only.', 'pizzalover', 'food,offtopic', NOW() - INTERVAL 1 DAY, 8, 2),
('Reviving an old project', 'Lost the original database years ago, rebuilding it from scratch just for fun.', 'dave', 'php,nostalgia', NOW(), 1, 0);

INSERT INTO comment (comment_content, comment_author, comment_creation_time, post_code) VALUES
('Hey, glad this is finally back online!', 'anon42', NOW() - INTERVAL 2 DAY, 1),
('Pineapple. Fight me.', 'pizzalover', NOW() - INTERVAL 20 HOUR, 3),
('Absolutely not, pineapple does not belong on pizza.', 'anon42', NOW() - INTERVAL 18 HOUR, 3),
('Good luck with the rebuild!', 'anon42', NOW() - INTERVAL 1 HOUR, 4);
