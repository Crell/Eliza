<?php
declare(strict_types=1);

namespace Crell\Eliza;

/**
 * Eliza Therapist.
 *
 * Based on https://www.smallsurething.com/implementing-the-famous-eliza-chatbot-in-python/
 */
class Eliza
{

    protected $reflections = [
        "am" => "are",
        "was" => "were",
        "i" => "you",
        "i'd" => "you would",
        "i've" => "you have",
        "i'll" => "you will",
        "my" => "your",
        "are" => "am",
        "you've" => "I have",
        "you'll" => "I will",
        "your" => "my",
        "yours" => "mine",
        "you" => "me",
        "me" => "you",
    ];

    protected $psychobabble = [
        'I need (.*)' => [
            "Why do you need {0}?",
            "Would it really help you to get {0}?",
            "Are you sure you need {0}?"],

        'Why don\'?t you ([^\?]*)\??' =>
            ["Do you really think I don't {0}?",
                "Perhaps eventually I will {0}.",
                "Do you really want me to {0}?"],

        'Why can\'?t I ([^\?]*)\??' =>
            ["Do you think you should be able to {0}?",
                "If you could {0}, what would you do?",
                "I don't know -- why can't you {0}?",
                "Have you really tried?"],

        'I can\'?t (.*)' =>
            ["How do you know you can't {0}?",
                "Perhaps you could {0} if you tried.",
                "What would it take for you to {0}?"],

        'I am (.*)' =>
            ["Did you come to me because you are {0}?",
                "How long have you been {0}?",
                "How do you feel about being {0}?"],

        'I\'?m (.*)' =>
            ["How does being {0} make you feel?",
                "Do you enjoy being {0}?",
                "Why do you tell me you're {0}?",
                "Why do you think you're {0}?"],

        'Are you ([^\?]*)\??' =>
            ["Why does it matter whether I am {0}?",
                "Would you prefer it if I were not {0}?",
                "Perhaps you believe I am {0}.",
                "I may be {0} -- what do you think?"],

        'What (.*)' =>
            ["Why do you ask?",
                "How would an answer to that help you?",
                "What do you think?"],

        'How (.*)' =>
            ["How do you suppose?",
                "Perhaps you can answer your own question.",
                "What is it you're really asking?"],

        'Because (.*)' =>
            ["Is that the real reason?",
                "What other reasons come to mind?",
                "Does that reason apply to anything else?",
                "If {0}, what else must be true?"],

        '(.*) sorry (.*)' =>
            ["There are many times when no apology is needed.",
                "What feelings do you have when you apologize?"],

        'Hello(.*)' =>
            ["Hello... I'm glad you could drop by today.",
                "Hi there... how are you today?",
                "Hello, how are you feeling today?"],

        'I think (.*)' =>
            ["Do you doubt {0}?",
                "Do you really think so?",
                "But you're not sure {0}?"],

        '(.*) friend (.*)' =>
            ["Tell me more about your friends.",
                "When you think of a friend, what comes to mind?",
                "Why don't you tell me about a childhood friend?"],

        'Yes' =>
            ["You seem quite sure.",
                "OK, but can you elaborate a bit?"],

        '(.*) computer(.*)' =>
            ["Are you really talking about me?",
                "Does it seem strange to talk to a computer?",
                "How do computers make you feel?",
                "Do you feel threatened by computers?"],

        'Is it (.*)' =>
            ["Do you think it is {0}?",
                "Perhaps it's {0} -- what do you think?",
                "If it were {0}, what would you do?",
                "It could well be that {0}."],

        'It is (.*)' =>
            ["You seem very certain.",
                "If I told you that it probably isn't {0}, what would you feel?"],

        'Can you ([^\?]*)\??' =>
            ["What makes you think I can't {0}?",
                "If I could {0}, then what?",
                "Why do you ask if I can {0}?"],

        'Can I ([^\?]*)\??' =>
            ["Perhaps you don't want to {0}.",
                "Do you want to be able to {0}?",
                "If you could {0}, would you?"],

        'You are (.*)' =>
            ["Why do you think I am {0}?",
                "Does it please you to think that I'm {0}?",
                "Perhaps you would like me to be {0}.",
                "Perhaps you're really talking about yourself?"],

        'You\'?re (.*)' =>
            ["Why do you say I am {0}?",
                "Why do you think I am {0}?",
                "Are we talking about you, or me?"],

        'I don\'?t (.*)' =>
            ["Don't you really {0}?",
                "Why don't you {0}?",
                "Do you want to {0}?"],

        'I feel (.*)' =>
            ["Good, tell me more about these feelings.",
                "Do you often feel {0}?",
                "When do you usually feel {0}?",
                "When you feel {0}, what do you do?"],

        'I have (.*)' =>
            ["Why do you tell me that you've {0}?",
                "Have you really {0}?",
                "Now that you have {0}, what will you do next?"],

        'I would (.*)' =>
            ["Could you explain why you would {0}?",
                "Why would you {0}?",
                "Who else knows that you would {0}?"],

        'Is there (.*)' =>
            ["Do you think there is {0}?",
                "It's likely that there is {0}.",
                "Would you like there to be {0}?"],

        'My (.*)' =>
            ["I see, your {0}.",
                "Why do you say that your {0}?",
                "When your {0}, how do you feel?"],

        'You (.*)' =>
            ["We should be discussing you, not me.",
                "Why do you say that about me?",
                "Why do you care whether I {0}?"],

        'Why (.*)' =>
            ["Why don't you tell me the reason why {0}?",
                "Why do you think {0}?"],

        'I want (.*)' =>
            ["What would it mean to you if you got {0}?",
                "Why do you want {0}?",
                "What would you do if you got {0}?",
                "If you got {0}, then what would you do?"],

        '(.*) mother(.*)' =>
            ["Tell me more about your mother.",
                "What was your relationship with your mother like?",
                "How do you feel about your mother?",
                "How does this relate to your feelings today?",
                "Good family relations are important."],

        '(.*) father(.*)' =>
            ["Tell me more about your father.",
                "How did your father make you feel?",
                "How do you feel about your father?",
                "Does your relationship with your father relate to your feelings today?",
                "Do you have trouble showing affection with your family?"],

        '(.*) child(.*)' =>
            ["Did you have close friends as a child?",
                "What is your favorite childhood memory?",
                "Do you remember any dreams or nightmares from childhood?",
                "Did the other children sometimes tease you?",
                "How do you think your childhood experiences relate to your feelings today?"],

        '(.*)\?' =>
            ["Why do you ask that?",
                "Please consider whether you can answer your own question.",
                "Perhaps the answer lies within yourself?",
                "Why don't you tell me?"],

        '(.*)' =>
            ["Please tell me more.",
                "Let's change focus a bit... Tell me about your family.",
                "Can you elaborate on that?",
                "Why do you say that {0}?",
                "I see.",
                "Very interesting.",
                "{0}.",
                "I see.  And what does that tell you?",
                "How does that make you feel?",
                "How do you feel when you say that?"]
    ];

    protected function reflect(string $fragment) : string
    {
        $tokens = explode(' ', strtolower($fragment));
        foreach ($tokens as $token) {
            if (in_array($token, $this->reflections)) {
                $tokens[$token] = $this->reflections[$token];
            }
        }

        return implode(' ', $tokens);
    }

    public function analyze(string $statement) : string
    {
        foreach ($this->psychobabble as $pattern => $responses) {
            if (preg_match('/' . $pattern . '/', trim($statement, '.!'), $matches, PREG_UNMATCHED_AS_NULL)) {
                // This only supports one placeholder; it could be better.
                $response = $responses[array_rand($responses)];
                if (isset($matches[1])) {
                    $response = str_replace('{0}', $this->reflect($matches[1]), $response);
                }
                return $response;
            }
        }

        return "Say again?";
    }
}

