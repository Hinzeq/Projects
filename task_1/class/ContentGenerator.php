<?php

namespace Project;

class ContentGenerator
{
    private array $newFileText;
    private string $wordToMix;
    private string $newWord;
    private bool $newLine;
    private string $punctuation;
    private array $middleWordPart;

    public function generateContent(array $content): array
    {
        $i = 0;
        $this->newFileText = [];
        foreach ($content as $singleLine) {
            foreach ($singleLine as $this->wordToMix) {
                $this->generateWord();
                $this->newFileText[$i][] = $this->newWord;
            }
            $i++;
        }
        return $this->newFileText;
    }

    private function generateWord(): void
    {
        $this->checkNewLine();
        $this->checkPunctuation();
        $this->generateMiddleWordPart();
        $this->generateNewWord();
    }

    private function checkNewLine(): void
    {
        if (strstr($this->wordToMix, PHP_EOL)) {
            $this->wordToMix = str_replace(PHP_EOL, '', $this->wordToMix);
            $this->newLine = true;
        } else {
            $this->newLine = false;
        }
    }

    private function checkPunctuation(): void
    {
        $this->punctuation = ctype_punct(substr($this->wordToMix, -1))
            ? substr($this->wordToMix, -1)
            : '';
    }

    private function generateMiddleWordPart(): void
    {
        $this->middleWordPart = mb_str_split(
            mb_substr(
                $this->wordToMix, 
                1, 
                $this->punctuation ? -2 : -1
            )
        );
        shuffle($this->middleWordPart);
    }

    private function generateNewWord(): void
    {
        if (!isset($this->wordToMix[0])) {
            $this->newWord = "\n";
        } else {
            $this->newWord = $this->wordToMix[0]
                . implode('', $this->middleWordPart)
                . mb_substr($this->wordToMix, $this->punctuation ? -2 : -1) 
                . ($this->newLine ? "\n" : '');
        }
    }
}
