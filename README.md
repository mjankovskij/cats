# cats
Homework

http://yourpage.com/{N}
{N} - Number of page between 1 and 1000000.
All pages are cached for 60's, on reloading the same page - time starts from 0.
When you go to a new page, the cats will be taken from the list, starting with the last found +1 in the json.

If you use for ex. url http://yourpage.com/dir/one_more/{N}
Change install dir in ./index.php

All data saved in ./files/logs.json
Cats list in ./files/cats.txt
