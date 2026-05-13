import { useState } from "react"

export default function Joke(props) {
    /**
     * Challenge:
     * - Create state `isShown` (boolean, default to `false`)
     * - Add a button that toggles the value back and forth
     */
    const [isShown, setIsShown] = useState(0)
    const toggle = () => {
        setIsShown(prevValue => !prevValue)
    }

    console.log(isShown)
    return (
        <div>
            {props.setup && <h3>{props.setup}</h3>}
            <p>{isShown ? props.punchline : null}</p>
            <hr />
            <button onClick={toggle}>button</button>
        </div>
    )
}