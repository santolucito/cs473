import sys, json
import random
import copy








def main():
# load the game array
    card_arrays = json.loads(sys.argv[1])
    
# get the data from the array
    computer_cards = card_arrays[0]
    center_card = card_arrays[1]
    user_cards = card_arrays[2]
    round_number = card_arrays[3][0]
    game_number = card_arrays[3][1]
    winner = card_arrays[3][2]
    user_action = card_arrays[4]

    team_win_round1 = 9
    team_win_round2 = 12
# check if the user took a single win
    if user_action[0] == 2:
        winner = 1
        card_arrays[3][2] = winner
        print json.dumps(card_arrays)
        return

# the deterministic games

    game_number = 5
    games = []


# 2 control games
    games.append([[4,5,5,5,7,7,1,1,6,2],[7,7,1,6,1,3,4,5],[7,8,1,8,8,3,4,2,6,5],[[4,5],[5,5],[5,5],[4,5],[4,7],[5,7],[1,4],[1,5]],[[0,0],[0,0],[0,0],[0,0],[0,0],[0,0],[0,0],[0,0]]])

    games.append([[3, 4, 4, 6, 6, 5, 7, 7, 8, 1], [7, 6, 1, 5, 8, 1, 6, 4], [1, 4, 5, 5, 7, 2, 1, 6, 4, 5], [[3, 4], [3, 4], [6, 3], [6, 4], [4, 4], [7, 5], [7, 7], [7, 3]], [[0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0]]])
    games.append([[7, 1, 1, 8, 8, 2, 4, 4, 5, 3], [4, 8, 3, 2, 5, 3, 8, 1], [3, 1, 2, 2, 4, 6, 3, 8, 1, 2], [[7, 1], [7, 1], [8, 7], [8, 1], [1, 1], [4, 2], [4, 4], [4, 7]], [[0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0]]])


# 3 control games
# games.append([[3, 4, 4, 6, 6, 5, 7, 7, 8, 1], [7, 6, 1, 5, 8, 1, 6, 4], [1, 4, 5, 5, 7, 2, 1, 6, 4, 5], [[3, 4], [3, 4], [4, 4], [6, 3], [6, 4], [7, 5], [7, 7], [7, 3]], [[0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0]]])
# games.append([[8, 2, 2, 5, 5, 1, 7, 7, 4, 6], [7, 5, 6, 1, 4, 6, 5, 2], [6, 2, 1, 1, 7, 3, 6, 5, 2, 1], [[8, 2], [8, 2], [2, 2], [5, 8], [5, 2], [7, 1], [7, 7], [7, 8]], [[0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0]]])
# games.append([[7, 1, 1, 4, 4, 8, 6, 6, 3, 5], [6, 4, 5, 8, 3, 5, 4, 1], [5, 1, 8, 8, 6, 2, 5, 4, 1, 8], [[7, 1], [7, 1], [1, 1], [4, 7], [4, 1], [6, 8], [6, 6], [6, 7]], [[0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0]]])

# behavior game (passive team behavior)
#    games.append([[7,6,7,2,2,4,3,8,4,1],[2,7,5,3,4,2,1,4],[1,3,8,8,6,4,7,3,2,8],[[7,6],[7,7],[7,2],[7,7],[2,4],[2,2],[4,6],[4,4]],[[0,0],[0,0],[0,0],[0,0],[0,0],[0,0],[0,0],[0,0]]])

# "behavior game for the control group"
games.append([[8, 5, 5, 5, 6, 6, 7, 7, 2, 4], [6, 6, 7, 2, 7, 1, 8, 5], [6, 3, 7,     3, 3, 1, 8, 4, 2, 5], [[8, 5], [5, 5], [5, 5], [8, 5], [8, 6], [5, 6], [7, 8], [7, 5]]    , [[0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0]]])


# "behavior game for the control group"
#    games.append([[8, 5, 5, 5, 6, 6, 7, 7, 2, 4], [6, 6, 7, 2, 7, 1, 8, 5], [6, 3, 7, 3, 3, 1, 8, 4, 2, 5], [[8, 5], [5, 5], [5, 5], [8, 5], [8, 6], [5, 6], [7, 8], [7, 5]] , [[0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0]]])


# 3 control games
# games.append([[2, 6, 6, 8, 8, 4, 1, 1, 3, 7], [1, 8, 7, 4, 3, 7, 8, 6], [7, 6, 4, 4, 1, 5, 7, 8, 6, 4], [[2, 6], [2, 6], [6, 6], [8, 2], [8, 6], [1, 4], [1, 1], [1, 2]], [[0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0]]])
# games.append([[2, 5, 5, 7, 7, 6, 8, 8, 1, 4], [8, 7, 4, 6, 1, 4, 7, 5], [4, 5, 6, 6, 8, 3, 4, 7, 5, 6], [[2, 5], [2, 5], [5, 5], [7, 2], [7, 5], [8, 6], [8, 8], [8, 2]], [[0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0]]])
# games.append([[1, 6, 6, 5, 5, 3, 4, 4, 2, 7], [4, 5, 7, 3, 2, 7, 5, 6], [7, 6, 3, 3, 4, 8, 7, 5, 6, 3], [[1, 6], [1, 6], [6, 6], [5, 1], [5, 6], [4, 3], [4, 4], [4, 1]], [[0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0]]])

# 2 control games
    games.append([[4, 8, 8, 2, 2, 7, 5, 5, 6, 1], [5, 2, 1, 7, 6, 1, 2, 8], [1, 8, 7, 7, 5, 3, 1, 2, 8, 7], [[4, 8], [4, 8], [2, 4], [2, 8], [8, 8], [5, 7], [5, 5], [5, 4]], [[0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0]]])
    games.append([[4, 7, 7, 5, 5, 8, 3, 3, 6, 2], [3, 5, 2, 8, 6, 2, 5, 7], [2, 7, 8, 8, 3, 1, 2, 5, 7, 8], [[4, 7], [4, 7], [5, 4], [5, 7], [7, 7], [3, 8], [3, 3], [3, 4]], [[0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0]]])

# behavior game (active team behavior)
#    games.append([[1,8,4,2,4,1,3,1,7,8],[4,3,1,7,4,8,8,1],[2,2,3,6,7,3,8,7,8,4],[[1,8],[4,8],[2,1],[1,8],[1,1],[3,8],[1,8],[4,7]],[[0,0],[0,0],[1,2],[0,0],[0,0],[1,3],[0,0],[1,7]]])

#control group
<<<<<<< HEAD
#    games.append([[6, 3, 3, 3, 1, 1, 2, 2, 5, 8], [1, 1, 2, 5, 2, 4, 6, 3], [1, 7, 2, 7, 7, 4, 6, 8, 5, 3], [[6, 3], [3, 3], [3, 3], [6, 3], [6, 1], [3, 1], [2, 6], [2, 3]] , [[0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0]]])
=======
    games.append([[6, 3, 3, 3, 1, 1, 2, 2, 5, 8], [1, 1, 2, 5, 2, 4, 6, 3], [1, 7, 2,     7, 7, 4, 6, 8, 5, 3], [[6, 3], [3, 3], [3, 3], [6, 3], [6, 1], [3, 1], [2, 6], [2, 3]]    , [[0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0]]])
>>>>>>> 4effb45068e3c05f1a9e89a787c12576b48b8259
# 3 control games
# games.append([[5, 8, 8, 7, 7, 3, 6, 6, 2, 1], [6, 7, 1, 3, 2, 1, 7, 8], [1, 8, 3, 3, 6, 4, 1, 7, 8, 3], [[5, 8], [5, 8], [8, 8], [7, 5], [7, 8], [6, 3], [6, 6], [6, 5]], [[0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0]]])
# games.append([[5, 2, 2, 8, 8, 7, 1, 1, 3, 6], [1, 8, 6, 7, 3, 6, 8, 2], [6, 2, 7, 7, 1, 4, 6, 8, 2, 7], [[5, 2], [5, 2], [2, 2], [8, 5], [8, 2], [1, 7], [1, 1], [1, 5]], [[0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0]]])
# games.append([[8, 3, 3, 6, 6, 1, 7, 7, 2, 5], [7, 6, 5, 1, 2, 5, 6, 3], [5, 3, 1, 1, 7, 4, 5, 6, 3, 1], [[8, 3], [8, 3], [3, 3], [6, 8], [6, 3], [7, 1], [7, 7], [7, 8]], [[0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0]]])

# 2 control games
    games.append([[6, 7, 7, 2, 2, 8, 4, 4, 3, 1], [4, 2, 1, 8, 3, 1, 2, 7], [1, 7, 8, 8, 4, 5, 1, 2, 7, 8], [[6, 7], [6, 7], [2, 6], [2, 7], [7, 7], [4, 8], [4, 4], [4, 6]], [[0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0]]])
    games.append([[6, 8, 8, 7, 7, 5, 1, 1, 2, 3], [1, 7, 3, 5, 2, 3, 7, 8], [3, 8, 5, 5, 1, 4, 3, 7, 8, 5], [[6, 8], [6, 8], [7, 6], [7, 8], [8, 8], [1, 5], [1, 1], [1, 6]], [[0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0]]])

# behavior game (passive and active team behavior leading to team win)
#    games.append([[3,3,7,6,4,2,5,4,5,4],[3,4,5,5,2,3,1,7,1],[2,6,7,6,5,5,1,8,8,1],[[3,3],[3,3],[3,7],[3,7],[3,2],[3,3],[2,3],[2,7]],[[0,0],[0,0],[1,6],[0,0],[0,0],[1,5],[0,0],[1,5]]])


# control group "behavior"
    games.append([[5, 6, 6, 6, 4, 4, 1, 1, 3, 7], [4, 4, 1, 3, 1, 2, 5, 6], [4, 8, 1,     8, 8, 2, 5, 7, 3, 6], [[5, 6], [6, 6], [6, 6], [5, 6], [5, 4], [6, 4], [1, 5], [1, 6]]    , [[0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0]]])



# control group "behavior"
#    games.append([[5, 6, 6, 6, 4, 4, 1, 1, 3, 7], [4, 4, 1, 3, 1, 2, 5, 6], [4, 8, 1, 8, 8, 2, 5, 7, 3, 6], [[5, 6], [6, 6], [6, 6], [5, 6], [5, 4], [6, 4], [1, 5], [1, 6]] , [[0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0]]])


# 3 control games
# games.append([[5, 3, 3, 7, 7, 2, 8, 8, 1, 4], [8, 7, 4, 2, 1, 4, 7, 3], [4, 3, 2, 2, 8, 6, 4, 7, 3, 2], [[5, 3], [5, 3], [3, 3], [7, 5], [7, 3], [8, 2], [8, 8], [8, 5]], [[0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0]]])
# games.append([[3, 1, 1, 7, 7, 8, 5, 5, 4, 6], [5, 7, 6, 8, 4, 6, 7, 1], [6, 1, 8, 8, 5, 2, 6, 7, 1, 8], [[3, 1], [3, 1], [1, 1], [7, 3], [7, 1], [5, 8], [5, 5], [5, 3]], [[0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0]]])
# games.append([[1, 2, 2, 8, 8, 6, 3, 3, 4, 5], [3, 8, 5, 6, 4, 5, 8, 2], [5, 2, 6, 6, 3, 7, 5, 8, 2, 6], [[1, 2], [1, 2], [2, 2], [8, 1], [8, 2], [3, 6], [3, 3], [3, 1]], [[0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0]]])

# 2 control games

    games.append([[1, 2, 2, 8, 8, 5, 3, 3, 6, 4], [3, 8, 4, 5, 6, 4, 8, 2], [4, 2, 5, 5, 3, 7, 4, 8, 2, 5], [[1, 2], [1, 2], [8, 1], [8, 2], [2, 2], [3, 5], [3, 3], [3, 1]], [[0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0]]])
    games.append([[3, 4, 4, 2, 2, 8, 1, 1, 5, 6], [1, 2, 6, 8, 5, 6, 2, 4], [6, 4, 8, 8, 1, 7, 6, 2, 4, 8], [[3, 4], [3, 4], [2, 3], [2, 4], [4, 4], [1, 8], [1, 1], [1, 3]], [[0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0]]])


# behavior game (passive + active team behavior) + expression of happiness after team win
#    games.append([[2, 2, 5, 6, 1, 3, 8, 1, 8, 1], [2, 1, 8, 8, 3, 2, 7, 5], [3, 6, 5, 6, 8, 8, 7, 4, 4, 7], [[2, 2], [2, 2], [2, 5], [2, 5], [2, 3], [2, 2], [3, 2], [3, 5]], [[0, 0], [0, 0], [1, 6], [0, 0], [0, 0], [1, 8], [0, 0], [1, 8]]])

# control group "behavior"
    games.append([[3, 7, 7, 7, 6, 6, 1, 1, 8, 2], [6, 6, 1, 8, 1, 4, 3, 7], [6, 5, 1,     5, 5, 4, 3, 2, 8, 7], [[3, 7], [7, 7], [7, 7], [3, 7], [3, 6], [7, 6], [1, 3], [1, 7]]    , [[0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0]]])


# control group "behavior"
#    games.append([[3, 7, 7, 7, 6, 6, 1, 1, 8, 2], [6, 6, 1, 8, 1, 4, 3, 7], [6, 5, 1, 5, 5, 4, 3, 2, 8, 7], [[3, 7], [7, 7], [7, 7], [3, 7], [3, 6], [7, 6], [1, 3], [1, 7]] , [[0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0]]])


# 2 control games

    games.append([[7, 8, 8, 3, 3, 1, 6, 6, 5, 4], [6, 3, 4, 1, 5, 4, 3, 8], [4, 8, 1, 1, 6, 2, 4, 3, 8, 1], [[7, 8], [7, 8], [3, 7], [3, 8], [8, 8], [6, 1], [6, 6], [6, 7]], [[0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0]]])
    games.append([[3, 1, 1, 8, 8, 2, 5, 5, 7, 6], [5, 8, 6, 2, 7, 6, 8, 1], [6, 1, 2, 2, 5, 4, 6, 8, 1, 2], [[3, 1], [3, 1], [8, 3], [8, 1], [1, 1], [5, 2], [5, 5], [5, 3]], [[0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0]]])

# 3 control games
# games.append([[5, 2, 2, 7, 7, 6, 8, 8, 3, 1], [8, 7, 1, 6, 3, 1, 7, 2], [1, 2, 6, 6, 8, 4, 1, 7, 2, 6], [[5, 2], [5, 2], [2, 2], [7, 5], [7, 2], [8, 6], [8, 8], [8, 5]], [[0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0]]])
# games.append([[6, 1, 1, 8, 8, 3, 7, 7, 2, 4], [7, 8, 4, 3, 2, 4, 8, 1], [4, 1, 3, 3, 7, 5, 4, 8, 1, 3], [[6, 1], [6, 1], [1, 1], [8, 6], [8, 1], [7, 3], [7, 7], [7, 6]], [[0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0]]])
# games.append([[1, 2, 2, 5, 5, 3, 4, 4, 8, 7], [4, 5, 7, 3, 8, 7, 5, 2], [7, 2, 3, 3, 4, 6, 7, 5, 2, 3], [[1, 2], [1, 2], [2, 2], [5, 1], [5, 2], [4, 3], [4, 4], [4, 1]], [[0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0]]])

# additional control games
# games.append([[4, 2, 2, 3, 3, 5, 1, 1, 6, 7], [1, 3, 7, 5, 6, 7, 3, 2], [7, 2, 5, 5, 1, 8, 7, 3, 2, 5], [[4, 2], [4, 2], [2, 2], [3, 4], [3, 2], [1, 5], [1, 1], [1, 4]], [[0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0]]])
# games.append([[3, 5, 5, 1, 1, 8, 2, 2, 6, 4], [2, 1, 4, 8, 6, 4, 1, 5], [4, 5, 8, 8, 2, 7, 4, 1, 5, 8], [[3, 5], [3, 5], [5, 5], [1, 3], [1, 5], [2, 8], [2, 2], [2, 3]], [[0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0]]])
# games.append([[5, 2, 2, 1, 1, 4, 6, 6, 8, 3], [6, 1, 3, 4, 8, 3, 1, 2], [3, 2, 4, 4, 6, 7, 3, 1, 2, 4], [[5, 2], [5, 2], [2, 2], [1, 5], [1, 2], [6, 4], [6, 6], [6, 5]], [[0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0]]])
# games.append([[7, 2, 2, 6, 6, 1, 5, 5, 8, 4], [5, 6, 4, 1, 8, 4, 6, 2], [4, 2, 1, 1, 5, 3, 4, 6, 2, 1], [[7, 2], [7, 2], [2, 2], [6, 7], [6, 2], [5, 1], [5, 5], [5, 7]], [[0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0]]])

    
    # get the computer action from the deterministic games
    computer_action = games[game_number-2][4][round_number-1]
    
# perform the action

# if a new game starts, deal two cards
    if round_number == 0:
        computer_cards.remove(0)
        user_cards.remove(0)
        computer_cards.append(games[game_number-2][0][0])
        computer_cards.append(games[game_number-2][0][1])
        user_cards.append(games[game_number-2][2][0])
        user_cards.append(games[game_number-2][2][1])
    else:

# otherwise, perform the action chosen by the players

        if user_action[0] == 0:
            user_cards.append(games[game_number-2][2][round_number + 1])
        elif user_action[0] == 1:
            card_value = user_action[1]
            computer_cards.append(card_value)
            user_cards.remove(card_value)
        if computer_action[0] == 0:
            computer_cards.append(games[game_number-2][0][round_number + 1])
        elif computer_action[0] == 1:
            card_value = computer_action[1]
            user_cards.append(card_value)
            computer_cards.remove(card_value)
# exception handling: if both players give the same card to the team mate,
# they both get a card
        if computer_action[0] == 1 and user_action[0] == 1 and computer_action[1] == user_action[1]:
            user_cards.append(games[game_number-2][2][round_number + 1])
            computer_cards.append(games[game_number-2][0][round_number + 1])
    

# set the new table card
    if round_number < 8:
        center_card = games[game_number-2][1][round_number]

# set the right cards visible
	visible_cards_computer = games[game_number-2][3][round_number]
        for i in range(2):
            card = visible_cards_computer[i]
            ind = computer_cards.index(card,i)
            temp = computer_cards[i]
            computer_cards[i] = card
            computer_cards[ind] = temp

# visible_cards_user = games[game_number-1][5][round_number]
# for i in range(2):
# card = visible_cards_user[i]
# if card in user_cards:
# ind = user_cards.index(card)
# temp = user_cards[i]
# user_cards[i] = card
# user_cards[ind] = temp
# else:
# temp = copy.deepcopy(user_cards)[i:]
# random.shuffle(temp)
# user_cards = user_cards[:i] + temp


# increment round number
    round_number += 1

# check if one of the players has a single win option
    nrSameCardsAsTableCard = 0
    for card in user_cards:
        if card == center_card:
            nrSameCardsAsTableCard += 1

# check if there is a team win
        for cardValue in range(1,9):
            nrCardsThisValue_user = 0
            nrCardsThisValue_computer = 0
            for card in user_cards:
                if card == cardValue:
                    nrCardsThisValue_user += 1
            if nrCardsThisValue_user >= 4:
                winner = 2
                break
            for card in computer_cards:
                if card == cardValue:
                    nrCardsThisValue_computer += 1
            if nrCardsThisValue_computer >= 4:
                winner = 2
                break
    if winner != 2:
        if nrSameCardsAsTableCard >= 2:
            winner = -1
        else:
            winner = 0

    if (game_number - 1 == team_win_round1 or game_number - 1== team_win_round2) and round_number == 9:
        winner = 2

# create the new card_arrays
    card_arrays[0] = computer_cards
    card_arrays[1] = [center_card]
    card_arrays[2] = user_cards
    card_arrays[3][0] = round_number
    card_arrays[3][1] = game_number
    card_arrays[3][2] = winner
    card_arrays[4] = user_action
    card_arrays[5] = computer_action
    print json.dumps(card_arrays)
    return

    


if __name__ == '__main__':
    main()
