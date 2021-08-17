const connectEl = document.getElementById("link-button");
const accountEl = document.getElementById("accounts");
const transactionEl = document.getElementById("transactions");

const fetchAccounts = async (publicToken) => {
    await window.axios.post("/accounts", { publicToken }).then((res) => {
        let accounts = res.data.accounts;
        let accoutsContent = "";
        accounts.forEach((account) => {
            accoutsContent += `<h3>Account Name: ${account.name}</h3>`;
            accoutsContent += `<p>Official Name: ${account.official_name}</p>`;
        });
        accountEl.innerHTML = accoutsContent;
        connectEl.style.display = "none";
        console.log(accounts);
    });
};

const fetchTransactions = async (publicToken) => {
    await window.axios.post("/transactions", { publicToken }).then((res) => {
        let transactions = res.data.transactions;
        let transectionsContent = "<h1>Transections:</h1>";
        transactions.forEach(
            ({
                account_id,
                ammount,
                category,
                iso_currency_code,
                name,
                payment_channel,
                transaction_id,
                transaction_type,
            }) => {
                transectionsContent += `<div class="transaction">
                <h3>account id: ${account_id}</h3>
                <p>ammount: ${ammount}</p>
                <p>category: ${category}</p>
                <p>iso currency code: ${iso_currency_code}</p>
                <p>name: ${name}</p>
                <p>payment channet: ${payment_channel}</p>
                <p>transection id: ${transaction_id}</p>
                <p>transection type: ${transaction_type}</p>
            </div>;`;
            }
        );
        transactionEl.innerHTML = transectionsContent;
        connectEl.style.display = "none";
        console.log(transactions);
    });
};

const fetchLinkToken = async () => {
    await window.axios.post("/create_link_token").then((res) => {
        const handler = Plaid.create({
            token: res.data.link_token,
            onSuccess: async (public_token, metadata) => {
                try {
                    let transactions = await fetchTransactions(public_token);
                } catch (err) {
                    console.log(err);
                }
            },
            onLoad: () => {},
            onExit: (err, metadata) => {},
            onEvent: (eventName, metadata) => {},
            receivedRedirectUri: null,
        });

        handler.open();
    });
};

connectEl.addEventListener("click", async () => {
    connectEl.innerHTML = "Loading...";
    await fetchLinkToken();
    connectEl.innerHTML = "Link Account";
});
