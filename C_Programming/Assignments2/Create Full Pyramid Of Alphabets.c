#include <stdio.h>

int main() {
    int n,i;
    char m ;
    printf("Enter the number char: ");
    scanf("%d", &n);
    for (i = 1; i <=n; i++)
    {
        for (m = 'A'; m < 'A' + i; m++)

            {
            printf("%c ", m);
             }
        printf("\n");
    }

}

