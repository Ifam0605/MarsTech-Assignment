#include <stdio.h>

// Function to reverse a number
int reverseNumber(int num) {
    int reversed = 0;
    while (num != 0) {
        int digit = num % 10;   // Extract the last digit
        reversed = reversed * 10 + digit; // Build the reversed number
        num /= 10;              // Remove the last digit
    }
    return reversed;
}

int main() {
    int number;

    // Input the number
    printf("Enter a number: ");
    scanf("%d", &number);

    // Call the reverseNumber function and display the result
    printf("The reversed number is: %d\n", reverseNumber(number));

    return 0;
}

