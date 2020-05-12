<?php

namespace Tests\Unit;

use App\CommentVote;
use PHPUnit\Framework\TestCase;

class CommentVoteTests extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testVoting()
    {
        $commentVote = new CommentVote([
            'comment_id' => 2,
            'user_id' => 3,
            'vote_type' => 'added',
        ]);

        $this->assertTrue($commentVote->getCommentId() == 2);
        $this->assertTrue($commentVote->getUserId() == 3);
        $this->assertTrue($commentVote->getVoteType() == 'added');

        $commentVote->setVoteType('subtracted'); // there are no other collateral effects
        $this->assertTrue($commentVote->getCommentId() == 2);
        $this->assertTrue($commentVote->getUserId() == 3);
        $this->assertTrue($commentVote->getVoteType() == 'subtracted');
    }
}
