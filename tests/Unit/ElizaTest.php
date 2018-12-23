<?php

declare(strict_types=1);

namespace Crell\Eliza\Tests\Unit;

use Crell\Eliza\Eliza;
use PHPUnit\Framework\TestCase;

final class ElizaTest extends TestCase
{
    /**
     * @test
     * @dataProvider responsesProvider
     */
    public function analyze_responses(string $statement, array $possibleResponses): void
    {
        $eliza = new Eliza();

        $response = $eliza->analyze($statement);

        $this->assertContains($response, $possibleResponses);
    }

    public function responsesProvider(): iterable
    {
        yield 'hello' => [
            'Hello there',
            [
                "Hello... I'm glad you could drop by today.",
                "Hi there... how are you today?",
                "Hello, how are you feeling today?"
            ]
        ];

        yield 'iNeed' => [
            'I need PRs',
            [
                "Why do you need prs?",
                "Would it really help you to get prs?",
                "Are you sure you need prs?"
            ]
        ];

        yield 'whyDontYou' => [
            "Why don't you create them?",
            [
                "Do you really think I don't create them?",
                "Perhaps eventually I will create them.",
                "Do you really want me to create them?"
            ]
        ];

        yield 'iCant' => [
            "I can't do it",
            [
                "How do you know you can't do it?",
                "Perhaps you could do it if you tried.",
                "What would it take for you to do it?"
            ]
        ];

        yield 'iAm' => [
            "I am happy",
            [
                "Did you come to me because you are happy?",
                "How long have you been happy?",
                "How do you feel about being happy?"
            ]
        ];

        yield 'iM' => [
            "I'm fast",
            [
                "How does being fast make you feel?",
                "Do you enjoy being fast?",
                "Why do you tell me you're fast?",
                "Why do you think you're fast?"
            ]
        ];

        yield 'areYou' => [
            "Are you mad?",
            [
                "Why does it matter whether I am mad?",
                "Would you prefer it if I were not mad?",
                "Perhaps you believe I am mad.",
                "I may be mad -- what do you think?"
            ]
        ];

        yield 'what' => [
            "What is this?",
            [
                "Why do you ask?",
                "How would an answer to that help you?",
                "What do you think?"
            ]
        ];

        yield 'how' => [
            "How are you?",
            [
                "How do you suppose?",
                "Perhaps you can answer your own question.",
                "What is it you're really asking?"
            ]
        ];

        yield 'how' => [
            "Because i like it.",
            [
                "Is that the real reason?",
                "What other reasons come to mind?",
                "Does that reason apply to anything else?",
                "If i like it, what else must be true?"
            ]
        ];

        yield 'sorry' => [
            "I actually felt a little sorry for her.",
            [
                "There are many times when no apology is needed.",
                "What feelings do you have when you apologize?"
            ]
        ];

        yield 'iThink' => [
            "I think you are helpful.",
            [
                "Do you doubt you are helpful me am?",
                "Do you really think so?",
                "But you're not sure you are helpful me am?"
            ]
        ];

        yield 'friend' => [
            "He is my friend from childhood?",
            [
                "Tell me more about your friends.",
                "When you think of a friend, what comes to mind?",
                "Why don't you tell me about a childhood friend?"
            ]
        ];

        yield 'yes' => [
            "Yes",
            [
                "You seem quite sure.",
                "OK, but can you elaborate a bit?"
            ]
        ];

        yield 'computer' => [
            "I like computers",
            [
                "Are you really talking about me?",
                "Does it seem strange to talk to a computer?",
                "How do computers make you feel?",
                "Do you feel threatened by computers?"
            ]
        ];
    }
}
